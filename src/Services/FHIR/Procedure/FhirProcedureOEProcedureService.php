<?php

/**
 * FhirProcedureOEProcedureService.php
 *
 * @package    DCL
 * @link       https://www.dcl.org
 * @author     Stephen Nielson <stephen@nielson.org>
 * @author     Jerry Padgett <sjpadgett@gmail.com>
 * @copyright  Copyright (c) 2021 Stephen Nielson <stephen@nielson.org>
 * @copyright  Copyright (c) 2025 Jerry Padgett <sjpadgett@gmail.com>
 * @license    https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Services\FHIR\Procedure;

use DCL\FHIR\R4\FHIRDomainResource\FHIRProcedure;
use DCL\FHIR\R4\FHIRElement\FHIRAnnotation;
use DCL\FHIR\R4\FHIRElement\FHIRCanonical;
use DCL\FHIR\R4\FHIRElement\FHIRCodeableConcept;
use DCL\FHIR\R4\FHIRElement\FHIRId;
use DCL\FHIR\R4\FHIRElement\FHIRMeta;
use DCL\FHIR\R4\FHIRResource\FHIRProcedure\FHIRProcedurePerformer;
use DCL\Services\CodeTypesService;
use DCL\Services\FHIR\Enum\EventStatusEnum;
use DCL\Services\FHIR\FhirCodeSystemConstants;
use DCL\Services\FHIR\FhirProvenanceService;
use DCL\Services\FHIR\FhirServiceBase;
use DCL\Services\FHIR\IPatientCompartmentResourceService;
use DCL\Services\FHIR\Traits\FhirServiceBaseEmptyTrait;
use DCL\Services\FHIR\Traits\PatientSearchTrait;
use DCL\Services\FHIR\Traits\VersionedProfileTrait;
use DCL\Services\FHIR\UtilsService;
use DCL\Services\ProcedureService;
use DCL\Services\Search\CompositeSearchField;
use DCL\Services\Search\DateSearchField;
use DCL\Services\Search\FhirSearchParameterDefinition;
use DCL\Services\Search\ISearchField;
use DCL\Services\Search\SearchFieldType;
use DCL\Services\Search\SearchModifier;
use DCL\Services\Search\ServiceField;
use DCL\Services\Search\StringSearchField;
use DCL\Services\Search\TokenSearchField;
use DCL\Services\Search\TokenSearchValue;
use DCL\Validators\ProcessingResult;

class FhirProcedureOEProcedureService extends FhirServiceBase implements IPatientCompartmentResourceService
{
    use FhirServiceBaseEmptyTrait;
    use PatientSearchTrait;
    use VersionedProfileTrait;


    /**
     * @see list_options order_types (Order Types)
     * TODO: @adunsulag is there a better place to put this?  Its duplicated in FhirDiagnosticReportLaboratoryService
     */
    const PROCEDURE_ORDER_TEST_TYPE = "laboratory_test";

    /**
     * @var ProcedureService
     */
    private $service;

    const USCGI_PROFILE_URI = 'http://hl7.org/fhir/us/core/StructureDefinition/us-core-procedure';

    public function __construct($fhirApiURL = null)
    {
        parent::__construct($fhirApiURL);
        $this->service = new ProcedureService();
    }

    /**
     * Returns an array mapping FHIR Procedure Resource search parameters to DCL Procedure search parameters
     *
     * @return array The search parameters
     */
    protected function loadSearchParameters(): array
    {
        return [
            'patient' => $this->getPatientContextSearchField(),
            'date' => new FhirSearchParameterDefinition('date', SearchFieldType::DATETIME, ['report_date']),
            'code' => new FhirSearchParameterDefinition('code', SearchFieldType::TOKEN, ['procedure_code', 'standard_code']),
            'status' => new FhirSearchParameterDefinition('status', SearchFieldType::TOKEN, ['result_status']),
            // FIXED: Use order_uuid (the procedure_order UUID) instead of report_uuid
            '_id' => new FhirSearchParameterDefinition('_id', SearchFieldType::TOKEN, [new ServiceField('order_uuid', ServiceField::TYPE_UUID)]),
            '_lastUpdated' => $this->getLastModifiedSearchField(),
        ];
    }

    /**
     * @return FhirSearchParameterDefinition|null
     */
    public function getLastModifiedSearchField(): ?FhirSearchParameterDefinition
    {
        return new FhirSearchParameterDefinition('_lastUpdated', SearchFieldType::DATETIME, ['report_date']);
    }

    /**
     * Searches for DCL records using DCL search parameters
     *
     * @param array<string, ISearchField> $DCLSearchParameters DCL search fields
     * @return ProcessingResult DCL records
     */
    protected function searchForDCLRecords($DCLSearchParameters): ProcessingResult
    {
        $DCLSearchParameters = is_array($DCLSearchParameters) ? $DCLSearchParameters : [];
        $DCLSearchParameters['procedure_type'] = new StringSearchField(
            'procedure_type',
            [self::PROCEDURE_ORDER_TEST_TYPE],
            SearchModifier::NOT_EQUALS_EXACT
        );

        // date has to be a compound search
        if (isset($DCLSearchParameters['report_date'])) {
            // need to have a condition of report_date = x OR (report_date is null AND date_ordered = x)
            $reportDateField = $DCLSearchParameters['report_date'];
            unset($DCLSearchParameters['report_date']);

            $orderedDateOrMissingReportDate = new CompositeSearchField('ordered_date_missing_report_date', [], true);
            $dateOrderedField = new DateSearchField('date_ordered', $reportDateField->getValues());
            $reportDateMissingField = new TokenSearchField('report_date', [new TokenSearchValue(true)]);
            $reportDateMissingField->setModifier(SearchModifier::MISSING);
            $orderedDateOrMissingReportDate->addChild($reportDateMissingField);
            $orderedDateOrMissingReportDate->addChild($dateOrderedField);

            $compositeField = new CompositeSearchField('performed_date', [], false);
            $compositeField->addChild($reportDateField);
            $compositeField->addChild($orderedDateOrMissingReportDate);
            $DCLSearchParameters['performed_date'] = $compositeField;
        }

        // FIXED: Don't require reports - we want to show all procedure orders
        // Remove the report_uuid filter to include orders without reports
        // Orders without reports will have status "in-progress" or "preparation"

        return $this->service->search($DCLSearchParameters);
    }


    /**
     * Parses an DCL procedure record, returning the equivalent FHIR Procedure Resource
     *
     * @param array   $dataRecord The source DCL data record
     * @param bool $encode Indicates if the returned resource is encoded into a string. Defaults to false.
     * @return FHIRProcedure
     */
    public function parseDCLRecord($dataRecord = [], $encode = false)
    {
        $procedureResource = new FHIRProcedure();

        // FIXED: Handle cases where there might be no reports yet
        $report = null;
        if (!empty($dataRecord['reports']) && is_array($dataRecord['reports'])) {
            $report = array_pop($dataRecord['reports']);
        }

        $meta = new FHIRMeta();
        $meta->setVersionId('1');

        // Use report date if available, otherwise use order date
        if (!empty($report['date'])) {
            $meta->setLastUpdated(UtilsService::getLocalDateAsUTC($report['date']));
        } elseif (!empty($dataRecord['date_ordered'])) {
            $meta->setLastUpdated(UtilsService::getLocalDateAsUTC($dataRecord['date_ordered']));
        } else {
            $meta->setLastUpdated(UtilsService::getDateFormattedAsUTC());
        }
        foreach ($this->getProfileForVersions(self::USCGI_PROFILE_URI, $this->getSupportedVersions()) as $profile) {
            $meta->addProfile($this->createProfile($profile));
        }

        $procedureResource->setMeta($meta);

        // FIXED: Use order_uuid (procedure_order.uuid) as the Procedure ID
        // This is the correct primary identifier for the procedure
        $id = new FHIRId();
        $id->setValue($dataRecord['order_uuid']);
        $procedureResource->setId($id);

        if (!empty($dataRecord['patient']['uuid'])) {
            $procedureResource->setSubject(UtilsService::createRelativeReference('Patient', $dataRecord['patient']['uuid']));
        } else {
            $procedureResource->setSubject(UtilsService::createDataMissingExtension());
        }

        if (!empty($dataRecord['encounter']['uuid'])) {
            $procedureResource->setEncounter(UtilsService::createRelativeReference('Encounter', $dataRecord['encounter']['uuid']));
        }

        if (!empty($dataRecord['provider']['uuid'])) {
            $performer = new FHIRProcedurePerformer();
            $performer->setActor(UtilsService::createRelativeReference('Practitioner', $dataRecord['provider']['uuid']));
            $procedureResource->addPerformer($performer);
        }

        $codesService = new CodeTypesService();
        if (!empty($dataRecord['diagnosis'])) {
            $codes = explode(";", (string) $dataRecord['diagnosis']);
            foreach ($codes as $code) {
                $codeParts = $codesService->parseCode($code);
                $codeParts['description'] = $codesService->lookup_code_description($code) ?? '';
                if (empty($codeParts['description'])) {
                    $codeParts['description'] = null;
                }
                $codeParts['system'] = $codesService->getSystemForCodeType($codeParts['code_type']);
                // if we don't have a system we need to just not return these values
                if (!empty($codeParts['system'])) {
                    $procedureResource->addReasonCode(UtilsService::createCodeableConcept([$codeParts['code'] => $codeParts]));
                }
            }
        }

        // code can be whatever the user provides but should usually be CPT4 or SNOMED.  If we can't detect the system
        // then we HAVE to go with standard code or report back nothing...
        $codeParts = $codesService->parseCode($dataRecord['code']);
        $fhirCodeableConcept = new FHIRCodeableConcept();
        if (!empty($codeParts['code'])) {
            $code = $codeParts['code'];
            $description = $codesService->lookup_code_description($code);
            $description = !empty($description) ? $description : null; // we can get an "" string back from lookup
            $system = $codesService->getSystemForCodeType($codeParts['code_type']) ?? null;
            if (!empty($system)) {
                $fhirCodeableConcept = UtilsService::createCodeableConcept(
                    [
                        $code => ['code' => $code, 'system' => $system, 'description' => $description]
                    ]
                );
            }
        }

        if (!empty($dataRecord['standard_code'])) {
            $code = $dataRecord['standard_code'];
            $system = FhirCodeSystemConstants::LOINC;
            $fullStandardCode = $codesService->getCodeWithType($dataRecord['standard_code'], CodeTypesService::CODE_TYPE_LOINC);
            $description = $codesService->lookup_code_description($fullStandardCode);
            $description = !empty($description) ? $description : $dataRecord['name']; // we can get an "" string back from lookup
            $fhirCodeableConcept->addCoding(UtilsService::createCoding($code, $description, $system));
        }

        if (empty($fhirCodeableConcept->getCoding())) {
            if (!empty($dataRecord['name'])) {
                $fhirCodeableConcept->setText($dataRecord['name']);
            } else {
                $fhirCodeableConcept = UtilsService::createDataAbsentUnknownCodeableConcept();
            }
        }
        $procedureResource->setCode($fhirCodeableConcept);

        // FIXED: Determine status based on whether reports exist
        $status = EventStatusEnum::COMPLETED;
        if (empty($report)) {
            // No report yet - procedure has been ordered but not performed
            $status = EventStatusEnum::PREPARATION; // or 'in-progress' depending on your workflow
        } elseif (!empty($report['results'])) {
            foreach ($report['results'] as $result) {
                if ($result['status'] != 'final') {
                    $status = EventStatusEnum::IN_PROGRESS;
                    break;
                }
            }
        }
        // FIXED: Use report date if available, otherwise order date
        if (!empty($report['date'])) {
            $procedureResource->setPerformedDateTime(UtilsService::getLocalDateAsUTC($report['date']));
        } elseif (!empty($dataRecord['date_ordered'])) {
            // Order placed but not yet performed
            $procedureResource->setPerformedDateTime(UtilsService::getLocalDateAsUTC($dataRecord['date_ordered']));
        } else {
            if ($status == EventStatusEnum::IN_PROGRESS || $status == EventStatusEnum::COMPLETED) {
                // we CAN'T by spec have in-progress or completed without a date
                $status = EventStatusEnum::UNKNOWN;
            }
            if ($this->getHighestCompatibleUSCoreProfileVersion() === self::PROFILE_VERSION_3_1_1) {
                // Profile 3.1.1 says to use data-absent-unknown for performedDateTime if not known
                // Profile 6.1.0+ says to skip the performedDateTime if not known
                $procedureResource->setPerformedDateTime(UtilsService::createDataMissingExtension());
            } // else for 6.1.0+ we just skip setting performedDateTime
        }

        $procedureResource->setStatus($status->value);


        if (!empty($report['notes'])) {
            $annotation = new FHIRAnnotation();
            $annotation->setText($report['notes']);
            $procedureResource->addNote($annotation);
        }

        // FIXED: basedOn should reference the ServiceRequest with the SAME UUID
        // A Procedure is the execution of a ServiceRequest (procedure_order)
        if (!empty($dataRecord['order_uuid'])) {
            $procedureResource->addBasedOn(
                UtilsService::createRelativeReference('ServiceRequest', $dataRecord['order_uuid'])
            );
        }

        // UsedReference for specimen reference support only valid for Device, Medication, Substance
        // @see https://www.hl7.org/fhir/us/core/StructureDefinition-us-core-procedure-definitions.html#Procedure.usedReference referenced on 11/08/2025
//        if (!empty($report['specimens'])) {
//            foreach ($report['specimens'] as $specimen) {
//                // Only include non-deleted specimens (deleted flag = 0)
//                if (!empty($specimen['uuid']) && ($specimen['deleted'] ?? '0') == '0') {
//                    $procedureResource->addUsedReference(
//                        UtilsService::createRelativeReference('Specimen', $specimen['uuid'])
//                    );
//                }
//            }
//        }

        // Add reasonReference support (in addition to reasonCode)
        // Both per US Core 8.0
        if (!empty($dataRecord['reason_reference_uuid'])) {
            $procedureResource->addReasonReference(
                UtilsService::createRelativeReference('Condition', $dataRecord['reason_reference_uuid'])
            );
        }

        if ($encode) {
            return json_encode($procedureResource);
        } else {
            return $procedureResource;
        }
    }

    /**
     * Creates the Provenance resource  for the equivalent FHIR Resource
     *
     * @param $dataRecord The source DCL data record
     * @param $encode     Indicates if the returned resource is encoded into a string. Defaults to True.
     * @return the FHIR Resource. Returned format is defined using $encode parameter.
     */
    public function createProvenanceResource($dataRecord, $encode = false)
    {
        if (!($dataRecord instanceof FHIRProcedure)) {
            throw new \BadMethodCallException("Data record should be correct instance class");
        }
        $fhirProvenanceService = new FhirProvenanceService();
        $reference = null;
        if (!empty($dataRecord->getPerformer()) && count($dataRecord->getPerformer()) == 1) {
            $reference = $dataRecord->getPerformer()[0]->getActor();
        }
        $fhirProvenance = $fhirProvenanceService->createProvenanceForDomainResource($dataRecord, $reference);

        if ($encode) {
            return json_encode($fhirProvenance);
        } else {
            return $fhirProvenance;
        }
    }

    /**
     * @param string|null $hint
     * @return string|null
     */
    private function normalizeProcedureCodingSystem(?string $hint): ?string
    {
        if (!$hint) {
            return null;
        }
        $h = strtolower($hint);
        if (str_contains($h, 'snomed')) {
            return 'http://snomed.info/sct';
        }
        if ($h === 'cpt' || str_contains($h, 'ama')) {
            return 'http://www.ama-assn.org/go/cpt';
        }
        if (str_contains($h, 'hcpcs')) {
            return 'http://www.cms.gov/Medicare/Coding/HCPCSReleaseCodeSets';
        }
        if (str_contains($h, 'icd10pcs') || str_contains($h, 'icd-10-pcs')) {
            return 'http://www.cms.gov/Medicare/Coding/ICD10';
        }
        if (str_contains($h, 'cdt')) {
            return 'http://www.ada.org/cdt';
        }
        if (str_contains($h, 'loinc')) {
            return 'http://loinc.org';
        }
        return $hint;
    }
    private function createProfile(string $profileUri): FHIRCanonical
    {
        $profile = new FHIRCanonical();
        $profile->setValue($profileUri);
        return $profile;
    }

    public function getSupportedVersions()
    {
        $highestVersion = $this->getHighestCompatibleUSCoreProfileVersion();
        // version 3.1.1 is NOT compatible with 7.0.0 and later due to breaking changes in Procedure resource with how performed[x] is handled
        return match ($highestVersion) {
            self::PROFILE_VERSION_3_1_1 => self::PROFILE_VERSIONS_V1,
            default => self::PROFILE_VERSIONS_V2
        };
    }
}

<?php

/**
 * FhirDiagnosticReportLaboratoryService.php
 *
 * @package DCL
 * @link      https://www.dcl.org
 * @author    Stephen Nielson <stephen@nielson.org>
 * @author    Jerry Padgett <sjpadgett@gmail.com>
 * @copyright Copyright (c) 2021 Stephen Nielson <stephen@nielson.org>
 * @copyright Copyright (c) 2025 Jerry Padgett <sjpadgett@gmail.com>
 * @license    https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Services\FHIR\DiagnosticReport;

use BadMethodCallException;
use DCL\FHIR\R4\FHIRDomainResource\FHIRDiagnosticReport;
use DCL\FHIR\R4\FHIRDomainResource\FHIRProvenance;
use DCL\FHIR\R4\FHIRElement\FHIRCanonical;
use DCL\FHIR\R4\FHIRElement\FHIRDateTime;
use DCL\FHIR\R4\FHIRElement\FHIRId;
use DCL\FHIR\R4\FHIRElement\FHIRInstant;
use DCL\FHIR\R4\FHIRElement\FHIRMeta;
use DCL\Services\FHIR\FhirCodeSystemConstants;
use DCL\Services\FHIR\FhirOrganizationService;
use DCL\Services\FHIR\FhirProvenanceService;
use DCL\Services\FHIR\FhirServiceBase;
use DCL\Services\FHIR\IPatientCompartmentResourceService;
use DCL\Services\FHIR\IResourceUSCIGProfileService;
use DCL\Services\FHIR\Traits\FhirServiceBaseEmptyTrait;
use DCL\Services\FHIR\Traits\PatientSearchTrait;
use DCL\Services\FHIR\Traits\VersionedProfileTrait;
use DCL\Services\FHIR\UtilsService;
use DCL\Services\ProcedureService;
use DCL\Services\Search\FhirSearchParameterDefinition;
use DCL\Services\Search\ISearchField;
use DCL\Services\Search\SearchFieldType;
use DCL\Services\Search\SearchModifier;
use DCL\Services\Search\ServiceField;
use DCL\Services\Search\TokenSearchField;
use DCL\Services\Search\TokenSearchValue;
use DCL\Validators\ProcessingResult;

class FhirDiagnosticReportLaboratoryService extends FhirServiceBase implements IResourceUSCIGProfileService, IPatientCompartmentResourceService
{
    use FhirServiceBaseEmptyTrait;
    use PatientSearchTrait;
    use VersionedProfileTrait;

    const USCGI_PROFILE_URI = 'http://hl7.org/fhir/us/core/StructureDefinition/us-core-diagnosticreport-lab';

    /**
     * @var ProcedureService
     */
    private ProcedureService $service;

    const LAB_CATEGORY = "LAB";

    /**
     * @see list_options order_types (Order Types)
     */
    const PROCEDURE_ORDER_TEST_TYPE = "laboratory_test";

    public function __construct($fhirApiURL = null)
    {
        parent::__construct($fhirApiURL);
        $this->service = new ProcedureService();
    }

    /**
     * Returns an array mapping FHIR Resource search parameters to DCL search parameters
     */
    protected function loadSearchParameters(): array
    {
        return  [
            'patient' => $this->getPatientContextSearchField(),
            'code' => new FhirSearchParameterDefinition('type', SearchFieldType::TOKEN, ['standard_code']),
            // we ignore category for now because it defaults to LAB, at some point in the future we may allow a different category
            'category' => new FhirSearchParameterDefinition('category', SearchFieldType::TOKEN, ['category']),
            'date' => new FhirSearchParameterDefinition('date', SearchFieldType::DATETIME, ['report_date']),
            '_id' => new FhirSearchParameterDefinition('_id', SearchFieldType::TOKEN, [new ServiceField('report_uuid', ServiceField::TYPE_UUID)]),
            '_lastUpdated' => $this->getLastModifiedSearchField(),
        ];
    }

    public function getLastModifiedSearchField(): ?FhirSearchParameterDefinition
    {
        return new FhirSearchParameterDefinition('_lastUpdated', SearchFieldType::DATETIME, ['report_date']);
    }

    public function supportsCategory($category): string
    {
        return $category === self::LAB_CATEGORY;
    }


    public function supportsCode($code): bool
    {
        // we'll let them search on any LOINC code, technically we could just search procedure_codes for a valid code
        // and return false if there is nothing there... but unless the queries get really inefficient, we can just
        // leave this here
        return true;
    }

    public function parseDCLRecord($dataRecord = [], $encode = false): FHIRDiagnosticReport
    {
        $report = new FHIRDiagnosticReport();
        $dataRecordReport = array_pop($dataRecord['reports']);
        $this->populateMeta($report, $dataRecordReport);

        $id = new FHIRId();
        $id->setValue($dataRecordReport['uuid']);
        $report->setId($id);

        if (!empty($dataRecordReport['date'])) {
            $utcDate = UtilsService::getLocalDateAsUTC($dataRecordReport['date']);
            $report->setEffectiveDateTime(new FHIRDateTime($utcDate));
            $report->setIssued(new FHIRInstant($utcDate));
        } else {
            $report->setEffectiveDateTime(UtilsService::createDataMissingExtension());
        }

        if (!empty($dataRecord['euuid'])) {
            $report->setEncounter(UtilsService::createRelativeReference('Encounter', $dataRecord['euuid']));
        }

        $fhirOrganizationService = new FhirOrganizationService();

        if (!empty($dataRecord['lab']['uuid'])) {
            $orgReference = UtilsService::createRelativeReference("Organization", $dataRecord['lab']['uuid']);
            $report->addPerformer($orgReference);
        } else {
            $report->addPerformer($fhirOrganizationService->getPrimaryBusinessEntityReference());
        }
        // director is stored in the users table and linked via procedure_providers.lab_director
        if (!empty($dataRecord['lab']['director_uuid'])) {
            $practitionerReference = UtilsService::createRelativeReference("Practitioner", $dataRecord['lab']['director_uuid']);
            $report->addPerformer($practitionerReference);
        }

        if (!empty($dataRecordReport['results'])) {
            foreach ($dataRecordReport['results'] as $result) {
                $obsReference = UtilsService::createRelativeReference("Observation", $result['uuid']);
                $resultText = is_string($result['text'] ?? null) ? $result['text'] : '';
                if ($resultText !== '') {
                    // @phpstan-ignore argument.type (legacy on-the-fly translation of dynamic value; migration tracked in #11498)
                    $obsReference->setDisplay(xl($resultText));
                }
                $report->addResult($obsReference);
            }
        }
        if (!empty($dataRecord['patient']['uuid'])) {
            $report->setSubject(UtilsService::createRelativeReference('Patient', $dataRecord['patient']['uuid']));
        }
        $report->addCategory(UtilsService::createCodeableConcept([
            self::LAB_CATEGORY => ['code' => self::LAB_CATEGORY, 'description' => "Laboratory", 'system' => FhirCodeSystemConstants::DIAGNOSTIC_SERVICE_SECTION_ID]
        ]));

        if (!empty($dataRecord['encounter']['uuid'])) {
            $report->setEncounter(UtilsService::createRelativeReference('Encounter', $dataRecord['encounter']['uuid']));
        }
        // Add basedOn to link to the originating order (REQUIRED per US Core 8.0)
        if (!empty($dataRecord['order_uuid'])) {
            $report->addBasedOn(
                UtilsService::createRelativeReference('ServiceRequest', $dataRecord['order_uuid'])
            );
        }
        // Add resultsInterpreter (for provenance - US Core 8.0)
        if (!empty($dataRecord['provider']['uuid'])) {
            $report->addResultsInterpreter(
                UtilsService::createRelativeReference('Practitioner', $dataRecord['provider']['uuid'])
            );
        }

        if (!empty($dataRecordReport['status'])) {
            $report->setStatus($dataRecordReport['status']);
        } else {
            $report->setStatus('final');
        }

        // note we use standard_code instead of code as we require a LOINC code here and standard_code is for LOINC
        // codes in the system.  @see procedure_type table if you are confused by the difference between procedure_code
        // and standard_code
        if (!empty($dataRecord['standard_code'])) {
            $code = UtilsService::createCodeableConcept([$dataRecord['standard_code'] =>
                ['code' => $dataRecord['standard_code'], 'description' => $dataRecord['name'], 'system' => FhirCodeSystemConstants::LOINC]
            ]);
            $report->setCode($code);
        } else {
            $report->setCode(UtilsService::createNullFlavorUnknownCodeableConcept());
        }

        return $report;
    }

    /**
     * Searches for DCL records using DCL search parameters
     * @param array<string, ISearchField> $DCLSearchParameters DCL search fields
     * @return ProcessingResult DCL records
     */
    protected function searchForDCLRecords($DCLSearchParameters): ProcessingResult
    {
        // this service ignores category_code
        if (isset($DCLSearchParameters['category'])) {
            unset($DCLSearchParameters['category']);
        }
        // procedure service can return procedures that have no attached report to them.  Because of this situation
        // we have to make sure we exclude any procedures where the report_uuid is empty
        if (empty($DCLSearchParameters['_id'])) {
            $DCLSearchParameters['_id'] = new TokenSearchField('report_uuid', [new TokenSearchValue(false)]);
            $DCLSearchParameters['_id']->setModifier(SearchModifier::MISSING);
        }

        if (isset($DCLSearchParameters['standard_code']) && $DCLSearchParameters['standard_code'] instanceof TokenSearchField) {
            $values = [];
            $modifier = null;
            foreach ($DCLSearchParameters['standard_code']->getValues() as $value) {
                // TODO: @adunsulag do we need to handle unknowable codes across all FHIR code systems?
                if ($value->getCode() == UtilsService::UNKNOWNABLE_CODE_DATA_ABSENT) {
                    $values = [new TokenSearchValue(true)];
                    $modifier = SearchModifier::MISSING;
                    break;
                } elseif ($value->getSystem() == FhirCodeSystemConstants::LOINC) {
                    // remove the system as procedure service only cares about the code itself
                    $values[] = new TokenSearchValue($value->getCode());
                } else {
                    $values[] = $value;
                }
            }
            $DCLSearchParameters['standard_code'] = new TokenSearchField('standard_code', $values);
            if (!empty($modifier)) {
                $DCLSearchParameters['standard_code']->setModifier($modifier);
            }
        }
        $DCLSearchParameters['procedure_type'] = new TokenSearchField('procedure_type', [new TokenSearchValue(self::PROCEDURE_ORDER_TEST_TYPE)]);
        return $this->service->search($DCLSearchParameters);
    }

    /**
     * Creates the Provenance resource  for the equivalent FHIR Resource
     *
     * @param FHIRDiagnosticReport $dataRecord The source DCL data record
     * @param bool $encode Indicates if the returned resource is encoded into a string. Defaults to True.
     * @return FHIRProvenance|string|false the FHIR Resource. Returned format is defined using $encode parameter.
     */
    public function createProvenanceResource($dataRecord, $encode = false): FHIRProvenance|string|false
    {
        if (!($dataRecord instanceof FHIRDiagnosticReport)) {
            throw new BadMethodCallException("Data record should be correct instance class");
        }
        $fhirProvenance = $this->getFhirProvenanceService()->createProvenanceForDomainResource($dataRecord);
        if ($fhirProvenance === null) {
            // Provenance can legitimately be unavailable (e.g. no resolvable organization/author
            // reference); FhirServiceBase::getAll() treats a falsy return as "no provenance
            // available" and continues (see issue #13054).
            return false;
        }
        return $encode ? json_encode($fhirProvenance) : $fhirProvenance;
    }

    /**
     * Seam so unit tests can substitute the provenance factory.
     */
    protected function getFhirProvenanceService(): FhirProvenanceService
    {
        return new FhirProvenanceService();
    }

    protected function populateMeta(FHIRDiagnosticReport $report, array $dataRecordReport): void
    {
        $fhirMeta = new FHIRMeta();
        $fhirMeta->setVersionId('1');
        if (!empty($dataRecordReport['date'])) {
            $fhirMeta->setLastUpdated(UtilsService::getLocalDateAsUTC($dataRecordReport['date']));
        } else {
            $fhirMeta->setLastUpdated(UtilsService::getDateFormattedAsUTC());
        }
        // Set profile (required, mustSupport)
        $this->addProfilesToMeta($fhirMeta, $dataRecordReport);
        $report->setMeta($fhirMeta);
    }

    /**
     * @param FHIRMeta $meta
     * @param array $dataRecord
     * @return void
     */
    protected function addProfilesToMeta(FHIRMeta $fhirMeta, array $dataRecordReport): void
    {
        $profiles = $this->getProfileForVersions(self::USCGI_PROFILE_URI, $this->getSupportedVersions());
        foreach ($profiles as $profileUrl) {
            $profile = new FHIRCanonical();
            $profile->setValue($profileUrl);
            $fhirMeta->addProfile($profile);
        }
    }
    public function getProfileURIs(): array
    {
        return $this->getProfileForVersions(self::USCGI_PROFILE_URI, $this->getSupportedVersions());
    }
}

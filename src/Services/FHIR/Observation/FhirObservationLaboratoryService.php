<?php

/**
 * FhirObservationLaboratoryService.php
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Stephen Nielson <stephen@nielson.org>
 * @copyright Copyright (c) 2021 Stephen Nielson <stephen@nielson.org>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Services\FHIR\Observation;

use DCL\Common\Utils\ValidationUtils;
use DCL\FHIR\R4\FHIRDomainResource\FHIRObservation;
use DCL\FHIR\R4\FHIRDomainResource\FHIRProvenance;
use DCL\FHIR\R4\FHIRElement\FHIRCodeableConcept;
use DCL\FHIR\R4\FHIRElement\FHIRId;
use DCL\FHIR\R4\FHIRElement\FHIRMeta;
use DCL\FHIR\R4\FHIRResource\FHIRObservation\FHIRObservationReferenceRange;
use DCL\Services\FHIR\FhirCodeSystemConstants;
use DCL\Services\FHIR\FhirProvenanceService;
use DCL\Services\FHIR\FhirServiceBase;
use DCL\Services\FHIR\IPatientCompartmentResourceService;
use DCL\Services\FHIR\IResourceUSCIGProfileService;
use DCL\Services\FHIR\Observation\Trait\FhirObservationTrait;
use DCL\Services\FHIR\Traits\FhirServiceBaseEmptyTrait;
use DCL\Services\FHIR\Traits\VersionedProfileTrait;
use DCL\Services\FHIR\UtilsService;
use DCL\Services\ProcedureService;
use DCL\Services\Search\FhirSearchParameterDefinition;
use DCL\Services\Search\ISearchField;
use DCL\Services\Search\SearchFieldException;
use DCL\Services\Search\SearchFieldType;
use DCL\Services\Search\ServiceField;
use DCL\Services\Search\TokenSearchField;
use DCL\Services\Search\TokenSearchValue;
use DCL\Validators\ProcessingResult;

class FhirObservationLaboratoryService extends FhirServiceBase implements IPatientCompartmentResourceService, IResourceUSCIGProfileService
{
    use FhirServiceBaseEmptyTrait;
    use VersionedProfileTrait;
    use FhirObservationTrait;

    // we set this to be 'Final' which has the follow interpretation
    // 'The observation is complete and there are no further actions needed.'
    // @see http://hl7.org/fhir/R4/valueset-observation-status.html
    const DEFAULT_OBSERVATION_STATUS = "final";

    const CATEGORY = "laboratory";
    const USCDI_PROFILE = 'http://hl7.org/fhir/us/core/StructureDefinition/us-core-observation-lab';

    /**
     * @var ProcedureService
     */
    private ProcedureService $service;

    private const COLUMN_MAPPINGS = [
    ];

    public function __construct($fhirApiURL = null)
    {
        parent::__construct($fhirApiURL);
//        $this->service = new ObservationLabService();
    }

    public function getProcedureService(): ProcedureService
    {
        $this->service ??= new ProcedureService();
        return $this->service;
    }

    public function setProcedureService(ProcedureService $service): void
    {
        $this->service = $service;
    }

    public function getResourcePathForCode($code): string
    {
        return "category=" . self::CATEGORY . "&code=" . $code;
    }

    public function getCodeFromResourcePath($resourcePath)
    {
        $query_vars = [];
        parse_str((string) $resourcePath, $query_vars);
        return $query_vars['code'] ?? null;
    }

    public function supportsCategory($category): bool
    {
        return ($category === self::CATEGORY);
    }

    public function supportsCode($code): bool
    {
        // we support pretty much any LOINC code, we could hit procedure_order_code and procedure_results to be
        // specific but we'll just let the query execute.
        return true;
    }


    /**
     * Returns an array mapping FHIR Resource search parameters to DCL search parameters
     */
    protected function loadSearchParameters(): array
    {
        return [
            'patient' => $this->getPatientContextSearchField(),
            'code' => new FhirSearchParameterDefinition('code', SearchFieldType::TOKEN, ['result_code']),
            'category' => new FhirSearchParameterDefinition('category', SearchFieldType::TOKEN, ['category']),
            'date' => new FhirSearchParameterDefinition('date', SearchFieldType::DATETIME, ['report_date']),
            '_id' => new FhirSearchParameterDefinition('_id', SearchFieldType::TOKEN, [new ServiceField('result_uuid', ServiceField::TYPE_UUID)]),
            '_lastUpdated' => $this->getLastModifiedSearchField()
        ];
    }

    public function getLastModifiedSearchField(): ?FhirSearchParameterDefinition
    {
        return new FhirSearchParameterDefinition('_lastUpdated', SearchFieldType::DATETIME, ['report_date']);
    }


    /**
     * Searches for DCL records using DCL search parameters
     *
     * @param array<string, ISearchField> $DCLSearchParameters DCL search fields
     * @return ProcessingResult records
     */
    protected function searchForDCLRecords($DCLSearchParameters): ProcessingResult
    {
        $processingResult = new ProcessingResult();

        try {
            // if we have a category let's remove it as its being passed from our upper layer and we don't want to map
            // it to our procedure codes.
            unset($DCLSearchParameters['category']);

            if (!empty($DCLSearchParameters['result_code'])) {
                if ($DCLSearchParameters['result_code'] instanceof TokenSearchField) {
                    /**
                     * @var TokenSearchField
                     */
                    $codeField = $DCLSearchParameters['result_code'];
                    // transform the code values into something our procedure service can understand
                    $codeField->transformValues(function ($tokenValue) {
                        // we only support LOINC codes here so if we have a system of LOINC we can strip it out
                        // every other system will just not return a result
                        if ($tokenValue instanceof TokenSearchValue && $tokenValue->getSystem() == FhirCodeSystemConstants::LOINC) {
                            return new TokenSearchValue($tokenValue->getCode());
                        }
                        return $tokenValue;
                    });
                }
            }
//            $result = $this->service->search($newSearchParams, true);
            $result = $this->getProcedureService()->search($DCLSearchParameters, true);
            $data = $result->getData() ?? [];

            // need to transform these into something we can consume
            foreach ($data as $record) {
                // each vital record becomes a 1 -> many record for our observations
                $this->parseDataRecordsIntoObservationRecords($processingResult, $record);
            }
        } catch (SearchFieldException $exception) {
            $processingResult->setValidationMessages([$exception->getField() => $exception->getMessage()]);
        }

        return $processingResult;
    }

    private function parseDataRecordsIntoObservationRecords(ProcessingResult $processingResult, $record)
    {
        $patient = $record['patient'] ?? null;

        if (!empty($record['reports'])) {
            foreach ($record['reports'] as $report) {
                if (!empty($report['results'])) {
                    foreach ($report['results'] as $result) {
                        $result['patient'] = $patient;
                        $result['report_date'] = $report['date'];

                        // IMPORTANT: Specimen data comes from report as an ARRAY
                        // Each result gets a reference to ALL specimens for that test line
                        if (!empty($report['specimens'])) {
                            $result['specimens'] = $report['specimens'];
                        }
                        $ranges = array_filter(array_map(ValidationUtils::validateFloat(...), explode('-', $record['range'] ?? '')));
                        $result['range_low'] = $ranges[0] ?? null;
                        $result['range_high'] = $ranges[0] ?? null;
                        $result['result_abnormal'] = $result['abnormal'] ?? null;
                        $result['result_abnormal_title'] ??= null;
                        $result['result_abnormal_codes'] ??= null;
                        $result['provider'] = $record['provider'] ?? null;
                        $result['encounter'] = $record['encounter'] ?? null;

                        $processingResult->addData($result);
                    }
                }
            }
        }
    }

    /**
     * Parses an DCL data record, returning the equivalent FHIR Resource
     *
     * @param $dataRecord The source DCL data record
     * @param $encode     Indicates if the returned resource is encoded into a string. Defaults to True.
     */
    public function parseDCLRecord($dataRecord = [], $encode = false): FHIRObservation
    {
        $observation = new FHIRObservation();
        $meta = new FHIRMeta();
        $meta->setVersionId('1');
        if (!empty($dataRecord['report_date'])) {
            $meta->setLastUpdated(UtilsService::getLocalDateAsUTC($dataRecord['report_date']));
        } else {
            $meta->setLastUpdated(UtilsService::getDateFormattedAsUTC());
        }
        // setup our profiles
        $meta = $this->addProfilesToMeta([
            self::USCDI_PROFILE
        ], $meta);
        $observation->setMeta($meta);

        $id = new FHIRId();
        $id->setValue($dataRecord['uuid']);
        $observation->setId($id);

        if (!empty($dataRecord['report_date'])) {
            $observation->setEffectiveDateTime(UtilsService::getLocalDateAsUTC($dataRecord['report_date']));
        } else {
            $observation->setEffectiveDateTime(UtilsService::createDataMissingExtension());
        }

        $obsCategoryCoding = UtilsService::createCodeableConcept([
            self::CATEGORY => [
                'code' => self::CATEGORY,
                'system' => FhirCodeSystemConstants::HL7_OBSERVATION_CATEGORY,
                'description' => "Laboratory"
            ]
        ]);
        $observation->addCategory($obsCategoryCoding);

        // ONC FHIR requirements require there is a text value for the code, otherwise the code is not reported.
        if (!empty($dataRecord['code']) && !empty($dataRecord['text'])) {
            $observation->setCode(UtilsService::createCodeableConcept([
                $dataRecord['code'] => [
                    'code' => $dataRecord['code'],
                    'system' => FhirCodeSystemConstants::LOINC,
                    'description' => $dataRecord['text']
                ]
            ]));
        } else {
            $observation->setCode(UtilsService::createNullFlavorUnknownCodeableConcept());
        }

        $status = $this->getValidStatus($dataRecord['status'] ?? 'unknown');
        $observation->setStatus($status);

        $ranges = array_filter(array_map(ValidationUtils::validateFloat(...), explode('-', $dataRecord['range'] ?? '')));
        $low = $ranges[0] ?? null;
        $high = $ranges[1] ?? null;
        if (isset($low) && isset($high)) {

            $referenceRange = new FHIRObservationReferenceRange();
            $referenceRange->setLow(UtilsService::createQuantity($low, $dataRecord['units'], $dataRecord['units']));
            $referenceRange->setHigh(UtilsService::createQuantity($high, $dataRecord['units'], $dataRecord['units']));
            $observation->addReferenceRange($referenceRange);
        }

        $this->setObservationValue($observation, $dataRecord);

        if (!empty($dataRecord['provider']['uuid']) && !empty($dataRecord['provider']['npi'])) {
            $observation->addPerformer(UtilsService::createRelativeReference('Practitioner', $dataRecord['provider']['uuid']));
        }

        if (!empty($dataRecord['comments'])) {
            $observation->addNote(['text' => $dataRecord['comments']]);
        }

        if (!empty($dataRecord['patient'])) {
            $observation->setSubject(UtilsService::createRelativeReference("Patient", $dataRecord['patient']['uuid']));
        }

        if (!empty($dataRecord['encounter']['uuid'])) {
            $observation->setEncounter(UtilsService::createRelativeReference("Encounter", $dataRecord['encounter']['uuid']));
        }

        // USCDI v5 Specimen - Handle MULTIPLE specimen references
        // Note: FHIR R4 Observation.specimen is 0..1 cardinality (single reference)
        // If multiple specimens exist, we have several options:
        // 1. Reference only the first specimen
        // 2. Create separate Observation resources for each specimen
        // 3. Use a contained resource or extension

        // Option 1: Reference the first specimen (most common approach)
        if (!empty($dataRecord['specimens']) && is_array($dataRecord['specimens'])) {
            // Reference the first specimen
            $firstSpecimen = $dataRecord['specimens'][0];
            if (!empty($firstSpecimen['uuid'])) {
                $observation->setSpecimen(
                    UtilsService::createRelativeReference('Specimen', $firstSpecimen['uuid'])
                );
            }

            // Optional: Add a note if there are multiple specimens
            if (count($dataRecord['specimens']) > 1) {
                $specimenNote = "Multiple specimens collected: ";
                $specimenIdentifiers = array_map(fn($spec): mixed => $spec['identifier'] ?? $spec['type'] ?? 'Unknown', $dataRecord['specimens']);
                $specimenNote .= implode(', ', $specimenIdentifiers);
                $observation->addNote(['text' => $specimenNote]);
            }
        } elseif (!empty($dataRecord['specimen']['uuid'])) {
            // Legacy support: single specimen object (backward compatibility)
            $observation->setSpecimen(
                UtilsService::createRelativeReference('Specimen', $dataRecord['specimen']['uuid'])
            );
        }

        // Interpretation (USCDI v5)
        if (!empty($dataRecord['result_abnormal'])) {
            // we will populate the text if we don't have a mapped code
            if (empty($dataRecord['result_abnormal_codes'])) {
                $interpretation = new FHIRCodeableConcept();
                $interpretation->setText($dataRecord['result_abnormal_title'] ?? $dataRecord['result_abnormal'] ?? 'Indeterminate');
            } else {
                $interpretation = UtilsService::createCodeableConcept([
                    $dataRecord['result_abnormal_codes'] => [
                        'code' => $dataRecord['result_abnormal_codes'],
                        'system' => FhirCodeSystemConstants::HL7_V3_OBSERVATION_INTERPRETATION,
                        'description' => $dataRecord['result_abnormal_title'] ?? null
                    ]
                ]);
            }
            $observation->addInterpretation($interpretation);
        }

        return $observation;
    }

    protected function setObservationValue(FHIRObservation $observation, array $dataRecord): void
    {
        $value = $dataRecord['result'] ?? null;
        $valueUnit = $dataRecord['units'] ?? null;
        $codeDescription = str_contains((string) $value, ':') ? $this->getCodeTypesService()->lookup_code_description($value) : null;
        // if no sub_observations, or components, we treat as a single value observation
        $children = $dataRecord['sub_observations'] ?? $dataRecord['components'] ?? [];
        $this->setObservationValueWithDetails($observation, $value, $valueUnit, $codeDescription, $children);
    }

    private function getValidStatus($status)
    {
        $statii = ['registered', 'preliminary', 'final', 'amended', 'corrected', 'cancelled', 'entered-in-error', 'unknown'];
        if (array_search($status, $statii) !== false) {
            return $status;
        }
        return "unknown";
    }

    private function getDescriptionForCode($code)
    {
        $codeMapping = self::COLUMN_MAPPINGS[$code] ?? null;
        if (isset($codeMapping)) {
            return $codeMapping['description'];
        }
        return "";
    }

    /**
     * Creates the Provenance resource  for the equivalent FHIR Resource
     *
     * @param      $dataRecord - The source DCL data record
     * @param bool $encode     - Indicates if the returned resource is encoded into a string. Defaults to True.
     * @return false|FHIRProvenance|string|null - the FHIR Resource. Returned format is defined using $encode parameter.
     */
    public function createProvenanceResource($dataRecord, $encode = false)
    {
        if (!($dataRecord instanceof FHIRObservation)) {
            throw new \BadMethodCallException("Data record should be correct instance class");
        }
        $fhirProvenanceService = new FhirProvenanceService();
        $performer = null;
        if (!empty($dataRecord->getPerformer())) {
            // grab the first one
            $performer = current($dataRecord->getPerformer());
        }
        $fhirProvenance = $fhirProvenanceService->createProvenanceForDomainResource($dataRecord, $performer);
        if ($encode) {
            return json_encode($fhirProvenance);
        } else {
            return $fhirProvenance;
        }
    }

    public function getPatientContextSearchField(): FhirSearchParameterDefinition
    {
        return new FhirSearchParameterDefinition('patient', SearchFieldType::REFERENCE, [new ServiceField('puuid', ServiceField::TYPE_UUID)]);
    }

    public function getProfileURIs(): array
    {
        return $this->getProfileForVersions(self::USCDI_PROFILE, $this->getSupportedVersions());
    }
}

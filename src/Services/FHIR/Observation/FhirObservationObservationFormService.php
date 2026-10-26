<?php

/*
 * FhirObservationObservationFormService.php
 * @package DCL
 * @link      https://www.dcl.org
 * @author    Stephen Nielson <snielson@discoverandchange.com>
 * @copyright Copyright (c) 2025 Stephen Nielson <snielson@discoverandchange.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Services\FHIR\Observation;

use DCL\FHIR\R4\FHIRDomainResource\FHIRObservation;
use DCL\FHIR\R4\FHIRElement\FHIRCanonical;
use DCL\FHIR\R4\FHIRElement\FHIRMeta;
use DCL\FHIR\R4\FHIRResource\FHIRDomainResource;
use DCL\Services\FHIR\FhirServiceBase;
use DCL\Services\FHIR\IPatientCompartmentResourceService;
use DCL\Services\FHIR\IResourceUSCIGProfileService;
use DCL\Services\FHIR\Observation\Trait\FhirObservationTrait;
use DCL\Services\ObservationService;
use DCL\Services\Search\CompositeSearchField;
use DCL\Services\Search\FhirSearchParameterDefinition;
use DCL\Services\Search\ISearchField;
use DCL\Services\Search\SearchFieldType;
use DCL\Services\Search\ServiceField;
use DCL\Services\Search\TokenSearchField;
use DCL\Validators\ProcessingResult;

class FhirObservationObservationFormService extends FhirServiceBase implements IPatientCompartmentResourceService, IResourceUSCIGProfileService
{
    use FhirObservationTrait;

    private ObservationService $observationService;
    const SUPPORTED_CATEGORIES = ['survey', 'exam', 'social-history', 'vital-signs', 'imaging', 'laboratory', 'procedure', 'therapy'];

    public function __construct($fhirApiURL = null)
    {
        parent::__construct($fhirApiURL);
        $this->observationService = new ObservationService();
        $this->observationService->setSystemLogger($this->getSystemLogger());
    }

    public function supportsCategory($category): bool
    {
        return in_array($category, self::SUPPORTED_CATEGORIES);
    }

    public function supportsCode(string $code): bool
    {
        // we support pretty much any LOINC code, we could hit procedure_order_code and procedure_results to be
        // specific but we'll just let the query execute.
        return true;
    }


    /**
     * Returns an array mapping FHIR Resource search parameters to DCL search parameters
     * @return array<string, FhirSearchParameterDefinition>
     */
    protected function loadSearchParameters(): array
    {
        return [
            'patient' => $this->getPatientContextSearchField(),
            'code' => new FhirSearchParameterDefinition('code', SearchFieldType::TOKEN, ['ob_code']),
            'category' => new FhirSearchParameterDefinition('category', SearchFieldType::TOKEN, ['ob_type']),
            'date' => new FhirSearchParameterDefinition('date', SearchFieldType::DATETIME, ['date']),
            '_id' => new FhirSearchParameterDefinition('_id', SearchFieldType::TOKEN, [
                new ServiceField('uuid', ServiceField::TYPE_UUID)
                ]),
            '_lastUpdated' => $this->getLastModifiedSearchField()
        ];
    }

    public function getLastModifiedSearchField(): ?FhirSearchParameterDefinition
    {
        return new FhirSearchParameterDefinition('_lastUpdated', SearchFieldType::DATETIME, ['date']);
    }

    private function createProfile(string $profileUri): FHIRCanonical
    {
        $profile = new FHIRCanonical();
        $profile->setValue($profileUri);
        return $profile;
    }
    protected function setObservationProfile(FHIRMeta $meta, FHIRObservation $observation, array $dataRecord): void
    {
        foreach ($this->getProfileForVersions(self::USCGI_PROFILE_URI, $this->getSupportedVersions()) as $profile) {
            $meta->addProfile($this->createProfile($profile));
        }
        $categoryCodes = array_map(fn($category) => $category->getCoding()[0]->getCode(), $observation->getCategory() ?? []);
        // check for linked questionnaire response
        if (!empty($dataRecord['questionnaire_response_uuid'])) {
            // verify we have a survey category
            if (in_array('survey', $categoryCodes)) {
                foreach ($this->getProfileForVersions(self::USCGI_SCREENING_ASSESSMENT_URI, $this->getSupportedVersions()) as $profile) {
                    $meta->addProfile($this->createProfile($profile));
                }
            }
        }
    }

    /**
     * Searches for DCL records using DCL search parameters
     * @param array<string, ISearchField> $DCLSearchParameters DCL search fields
     * @return ProcessingResult DCL records
     */
    protected function searchForDCLRecords($DCLSearchParameters): ProcessingResult
    {
        if (isset($DCLSearchParameters['ob_code'])) {
            // need to loop through and grab all of our systems that we support for observation codes
            // if there is a SNOMED system then we need to handle that differently since we store the system separately
            /**
             * @var TokenSearchField $codeSearchField
             */
            $codeSearchField = $DCLSearchParameters['ob_code'];
            // this isn't ideal, but we have much more complex logic here since observation codes can come from multiple code systems
            // we need to break them down by system and then build a compound search field that includes code + code type for each system
            $compoundObCode = new CompositeSearchField('ob_code', [], false);
            $systemLookupHash = [];

            foreach ($codeSearchField->getValues() as $codeSearchFieldValue) {
                $system = $codeSearchFieldValue->getSystem() ?? null;
                $systemKey = $system ?? '';
                if (isset($systemLookupHash[$systemKey])) {
                    $codeTypes = $systemLookupHash[$systemKey];
                } else {
                    $codeTypes = $this->getCodeTypesService()->getCodeTypeListForSystem($system);
                    $systemLookupHash[$systemKey] = $codeTypes;
                }
                if (!empty($codeTypes)) {
                    $compoundObCodeWithCodeType = new CompositeSearchField('ob_code_code_type', [], true);
                    $compoundObCodeWithCodeType->addChild(new TokenSearchField('ob_code', [$codeSearchFieldValue->getCode()]));
                    $compoundObCodeWithCodeType->addChild(new TokenSearchField('code_type', $codeTypes));
                    $compoundObCode->addChild($compoundObCodeWithCodeType);
                } else {
                    $compoundObCode->addChild(new TokenSearchField('ob_code', [$codeSearchFieldValue->getCode()]));
                }
            }
            $DCLSearchParameters['ob_code'] = $compoundObCode;
        }
        // we grab the records and grab any children records and populate them if we have them.
        return $this->observationService->searchAndPopulateChildObservations($DCLSearchParameters);
    }

    public function parseDCLRecord($dataRecord = [], $encode = false): FHIRDomainResource|string
    {
        // convert fields in the data array to the format that FhirObservationTrait expects
        $dataRecord['last_updated_time'] = $dataRecord['date'];
        return $this->parseObservationDCLRecord($dataRecord, $encode);
    }

    /**
     * Set observation value or dataAbsentReason (mustSupport, constraint us-core-2)
     */
    protected function setObservationValue(FHIRObservation $observation, array $dataRecord): void
    {
        $this->setObservationValueWithDetails(
            $observation,
            $dataRecord['ob_value'] ?? null,
            $dataRecord['ob_unit'] ?? null,
            $dataRecord['ob_value_code_description'] ?? null,
            $dataRecord['sub_observations'] ?? []
        );
    }

    public function getPatientContextSearchField(): FhirSearchParameterDefinition
    {
        return new FhirSearchParameterDefinition('patient', SearchFieldType::REFERENCE, [new ServiceField('puuid', ServiceField::TYPE_UUID)]);
    }

    public function getSupportedVersions(): array
    {
        return self::PROFILE_VERSIONS_V2;
    }

    public function getProfileURIs(): array
    {
        $profileSets = [
            $this->getProfileForVersions(self::USCGI_PROFILE_URI, $this->getSupportedVersions())
            , $this->getProfileForVersions(self::USCGI_SCREENING_ASSESSMENT_URI, $this->getSupportedVersions())
        ];
        return array_merge(...$profileSets);
    }
}

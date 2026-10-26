<?php

/**
 * FhirPatientDocumentReferenceService.php
 * @package DCL
 * @link      https://www.dcl.org
 * @author    Stephen Nielson <stephen@nielson.org>
 * @copyright Copyright (c) 2021 Stephen Nielson <stephen@nielson.org>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Services\FHIR\DocumentReference;

use DCL\FHIR\R4\FHIRDomainResource\FHIRDocumentReference;
use DCL\FHIR\R4\FHIRElement\FHIRExtension;
use DCL\Services\CodeTypesService;
use DCL\Services\FHIR\DocumentReference\Enum\DocumentReferenceCategoryEnum;
use DCL\Services\FHIR\DocumentReference\Trait\FhirDocumentReferenceTrait;
use DCL\Services\FHIR\FhirCodeSystemConstants;
use DCL\Services\FHIR\FhirServiceBase;
use DCL\Services\FHIR\IPatientCompartmentResourceService;
use DCL\Services\FHIR\Traits\PatientSearchTrait;
use DCL\Services\FHIR\UtilsService;
use DCL\Services\PatientAdvanceDirectiveService;
use DCL\Services\Search\FhirSearchParameterDefinition;
use DCL\Services\Search\ISearchField;
use DCL\Services\Search\SearchFieldType;
use DCL\Services\Search\SearchModifier;
use DCL\Services\Search\ServiceField;
use DCL\Services\Search\TokenSearchField;
use DCL\Services\Search\TokenSearchValue;
use DCL\Validators\ProcessingResult;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class FhirDocumentReferenceAdvanceCareDirectiveService extends FhirServiceBase implements IPatientCompartmentResourceService
{
    use PatientSearchTrait;
    use FhirDocumentReferenceTrait;

    const US_CORE_ADI_PROFILE = "http://hl7.org/fhir/us/core/StructureDefinition/us-core-adi-documentreference";

    /**
     * @var PatientAdvanceDirectiveService
     */
    private PatientAdvanceDirectiveService $service;

    public function __construct($fhirApiURL = null)
    {
        parent::__construct($fhirApiURL);
    }

    public function getProfileUrl(): string
    {
        return self::US_CORE_ADI_PROFILE;
    }

    public function setSession(SessionInterface $session): void
    {
        parent::setSession($session);
        $this->getADIService()->setSession($session);
    }

    public function getADIService(): PatientAdvanceDirectiveService
    {
        $this->service ??= new PatientAdvanceDirectiveService();
        return $this->service;
    }


    public function supportsCategory($category): bool
    {
        return DocumentReferenceCategoryEnum::tryFrom($category) == DocumentReferenceCategoryEnum::ADVANCE_CARE_DIRECTIVE;
    }


    public function supportsCode($code): bool
    {

        return false;
    }

    protected function loadSearchParameters(): array
    {
        return  [
            'patient' => $this->getPatientContextSearchField(),
            'date' => new FhirSearchParameterDefinition('date', SearchFieldType::DATETIME, ['date']),
            '_id' => new FhirSearchParameterDefinition('_id', SearchFieldType::TOKEN, [new ServiceField('uuid', ServiceField::TYPE_UUID)]),
            '_lastUpdated' => $this->getLastModifiedSearchField(),
            'category' => new FhirSearchParameterDefinition('category', SearchFieldType::TOKEN, ['category_codes']),
            // US Core 8.0 requires support for searching by category
        ];
    }

    public function getLastModifiedSearchField(): ?FhirSearchParameterDefinition
    {
        return new FhirSearchParameterDefinition('_lastUpdated', SearchFieldType::DATETIME, ['date']);
    }

    /**
     * @param array<string, ISearchField> $DCLSearchParameters DCL search fields
     * @return ProcessingResult DCL records
     */
    protected function searchForDCLRecords($DCLSearchParameters): ProcessingResult
    {
        if (isset($DCLSearchParameters['category'])) {
            // we have nothing with this category so we are going to return nothing as we never should have gotten here

            unset($DCLSearchParameters['category']);
        }
        if (isset($DCLSearchParameters['puuid'])) {
            // make sure that no other modifier such as NOT_EQUALS, OR missing=true is sent which would let system file names be
            // leaked out in the API
            $DCLSearchParameters['puuid']->setModifier(SearchModifier::EXACT);
        } else {
            // make sure we only return documents that are tied to patients
            $DCLSearchParameters['puuid'] = new TokenSearchField('puuid', [new TokenSearchValue(false, null)]);
            $DCLSearchParameters['puuid']->setModifier(SearchModifier::MISSING);
        }
        return $this->getADIService()->search($DCLSearchParameters);
    }

    protected function parseDCLRecordIntoFHIRDocumentReference($dataRecord = []): FHIRDocumentReference
    {
        $docReference = new FHIRDocumentReference();
        $this->populateMetaData($docReference, $dataRecord);
        $this->populateId($docReference, $dataRecord);
        $this->populateIdentifiers($docReference, $dataRecord);
        $this->populateDate($docReference, $dataRecord);
        $this->populateContext($docReference, $dataRecord);
        $this->populateContent($docReference, $dataRecord);
        $this->populateSubject($docReference, $dataRecord);
        $this->populateCategories($docReference, $dataRecord);
        $this->populateAuthor($docReference, $dataRecord);
        $this->populateStatus($docReference, $dataRecord);
        $this->populateType($docReference, $dataRecord);
        $this->populateAuthenticator($docReference, $dataRecord);
        $this->populateAuthenticationTime($docReference, $dataRecord);

        return $docReference;
    }

    protected function populateAuthenticator(FHIRDocumentReference $docReference, array $dataRecord): void
    {
        // Advance Care Directives do not have an authenticator
        if ($this->hasValidAuthenticator($dataRecord)) {
            $practitionerReference = UtilsService::createRelativeReference('Practitioner'
                , $dataRecord['authenticator']['uuid']);
            $docReference->setAuthenticator($practitionerReference);
        }
    }

    protected function hasValidAuthenticator(array $dataRecord): bool
    {
        return !empty($dataRecord['authenticator']['uuid']) && isset($dataRecord['authenticator']['date_reviewed']);
    }

    protected function populateAuthenticationTime(FHIRDocumentReference $docReference, array $dataRecord): void
    {
        if ($this->hasValidAuthenticator($dataRecord)) {
            $extension = new FHIRExtension();
            $extension->setUrl("http://hl7.org/fhir/us/core/StructureDefinition/us-core-authentication-time");
            $extension->setValueDateTime(UtilsService::getLocalDateAsUTC($dataRecord['authenticator']['date_reviewed']));
            $docReference->addExtension($extension);
        }
    }

    protected function populateCategories(FHIRDocumentReference $docReference, array $dataRecord): void
    {
        // mandatory category
        $docReference->addCategory(UtilsService::createCodeableConcept([
                '42348-3' => [
                    'system' => FhirCodeSystemConstants::LOINC,
                    'description' => 'Advance healthcare directives',
                    'code' => '42348-3'
                ]
        ]));
    }

    protected function populateType(FHIRDocumentReference $docReference, array $dataRecord): void
    {
        if (!empty($dataRecord['category_codes'])) {
            $codeTypeSystem = new CodeTypesService();
            $parsedCode = $codeTypeSystem->parseCode($dataRecord['category_codes']);
            $description = $codeTypeSystem->lookup_code_description($dataRecord['category_codes']);

            $docReference->setType(UtilsService::createCodeableConcept([
                $parsedCode['code'] => [
                    'system' => $codeTypeSystem->getSystemForCodeType($parsedCode['code_type']),
                    'description' => $description,
                    'code' => $parsedCode['code']
                ]
            ]));
        }
    }


    public function populateDate(FHIRDocumentReference $docReference, array $dataRecord)
    {
        if (!empty($dataRecord['created_date'])) {
            $docReference->setDate(UtilsService::getLocalDateAsUTC($dataRecord['created_date']));
        } else {
            $docReference->setDate(UtilsService::createDataMissingExtension());
        }
    }
}

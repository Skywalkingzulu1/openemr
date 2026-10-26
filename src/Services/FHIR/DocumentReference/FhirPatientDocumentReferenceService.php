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
use DCL\FHIR\R4\FHIRElement\FHIRCodeableConcept;
use DCL\FHIR\R4\FHIRElement\FHIRId;
use DCL\FHIR\R4\FHIRElement\FHIRIdentifier;
use DCL\FHIR\R4\FHIRElement\FHIRMeta;
use DCL\FHIR\R4\FHIRElement\FHIRPeriod;
use DCL\FHIR\R4\FHIRElement\FHIRString;
use DCL\FHIR\R4\FHIRResource\FHIRDocumentReference\FHIRDocumentReferenceContext;
use DCL\Services\DocumentService;
use DCL\Services\FHIR\DocumentReference\Enum\DocumentReferenceAdvancedDirectiveCodeEnum;
use DCL\Services\FHIR\DocumentReference\Enum\DocumentReferenceCategoryEnum;
use DCL\Services\FHIR\DocumentReference\Trait\FhirDocumentReferenceTrait;
use DCL\Services\FHIR\FhirCodeSystemConstants;
use DCL\Services\FHIR\FhirOrganizationService;
use DCL\Services\FHIR\FhirProvenanceService;
use DCL\Services\FHIR\FhirServiceBase;
use DCL\Services\FHIR\IPatientCompartmentResourceService;
use DCL\Services\FHIR\Traits\FhirServiceBaseEmptyTrait;
use DCL\Services\FHIR\Traits\PatientSearchTrait;
use DCL\Services\FHIR\UtilsService;
use DCL\Services\Search\CompositeSearchField;
use DCL\Services\Search\FhirSearchParameterDefinition;
use DCL\Services\Search\ISearchField;
use DCL\Services\Search\SearchFieldType;
use DCL\Services\Search\SearchModifier;
use DCL\Services\Search\ServiceField;
use DCL\Services\Search\StringSearchField;
use DCL\Services\Search\TokenSearchField;
use DCL\Services\Search\TokenSearchValue;
use DCL\Validators\ProcessingResult;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class FhirPatientDocumentReferenceService extends FhirServiceBase implements IPatientCompartmentResourceService
{
    use FhirServiceBaseEmptyTrait;
    use PatientSearchTrait;
    use FhirDocumentReferenceTrait;

    /**
     * @var DocumentService
     */
    private DocumentService $service;

    public function __construct($fhirApiURL = null)
    {
        parent::__construct($fhirApiURL);
        $this->service = new DocumentService();
    }

    public function setSession(SessionInterface $session): void
    {
        parent::setSession($session);
        $this->service->setSession($session);
    }


    public function supportsCategory($category): bool
    {
        return !in_array(DocumentReferenceCategoryEnum::tryFrom($category), DocumentReferenceCategoryEnum::cases());
    }


    public function supportsCode($code): bool
    {
        // exclude advanced directive codes as those are handled by another service
        return !in_array(DocumentReferenceAdvancedDirectiveCodeEnum::tryFrom($code), DocumentReferenceAdvancedDirectiveCodeEnum::cases());
    }

    protected function loadSearchParameters(): array
    {
        return  [
            'patient' => $this->getPatientContextSearchField(),
            'date' => new FhirSearchParameterDefinition('date', SearchFieldType::DATETIME, ['date']),
            'category' => new FhirSearchParameterDefinition('category', SearchFieldType::DATETIME, ['category_codes']),
            'type' => new FhirSearchParameterDefinition('type', SearchFieldType::DATETIME, ['category_codes']),
            '_id' => new FhirSearchParameterDefinition('_id', SearchFieldType::TOKEN, [new ServiceField('uuid', ServiceField::TYPE_UUID)]),
            '_lastUpdated' => $this->getLastModifiedSearchField(),
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
        if (isset($DCLSearchParameters['patient'])) {
            // make sure that no other modifier such as NOT_EQUALS, OR missing=true is sent which would let system file names be
            // leaked out in the API
            $DCLSearchParameters['patient']->setModifier(SearchModifier::EXACT);
        } else {
            // make sure we only return documents that are tied to patients
            $DCLSearchParameters['patient'] = new TokenSearchField('puuid', [new TokenSearchValue(false, null)]);
            $DCLSearchParameters['patient']->setModifier(SearchModifier::MISSING);
        }
        // we need to exclude the adi codes here as those are handled by another service
        // going to use a NOT_EQUALS_EXACT modifier on a string field for this
        $tokenField = new StringSearchField('category_codes', DocumentReferenceAdvancedDirectiveCodeEnum::getFullDCLCodeList(), SearchModifier::NOT_EQUALS_EXACT, true);
        if (isset($DCLSearchParameters['category_codes'])) {
            $compositeField = new CompositeSearchField('codes-filter', [], false);
            $compositeField->addChild($DCLSearchParameters['category_codes']);
            $compositeField->addChild($tokenField);
        } else {
            $DCLSearchParameters['category_codes'] = $tokenField;
        }
        return $this->service->search($DCLSearchParameters);
    }

    public function parseDCLRecord($dataRecord = [], $encode = false): FHIRDocumentReference
    {
        $docReference = new FHIRDocumentReference();
        $fhirMeta = new FHIRMeta();
        $fhirMeta->setVersionId('1');
        if (!empty($dataRecord['date'])) {
            $fhirMeta->setLastUpdated(UtilsService::getLocalDateAsUTC($dataRecord['date']));
        } else {
            $fhirMeta->setLastUpdated(UtilsService::getDateFormattedAsUTC());
        }
        $docReference->setMeta($fhirMeta);

        $id = new FHIRId();
        $id->setValue($dataRecord['uuid']);
        $docReference->setId($id);

        $identifier = new FHIRIdentifier();
        $identifier->setValue(new FHIRString($dataRecord['uuid']));
        $docReference->addIdentifier($identifier);

        // TODO: @adunsulag need to support content.attachment.url

        if (!empty($dataRecord['date'])) {
            $docReference->setDate(UtilsService::getLocalDateAsUTC($dataRecord['date']));
        } else {
            $docReference->setDate(UtilsService::createDataMissingExtension());
        }

        if (!empty($dataRecord['euuid'])) {
            $context = new FHIRDocumentReferenceContext();

            // we currently don't track anything dealing with start and end date for the context
            if (!empty($dataRecord['encounter_date'])) {
                $period = new FHIRPeriod();
                $period->setStart(UtilsService::getLocalDateAsUTC($dataRecord['encounter_date']));
                $context->setPeriod($period);
            }
            $context->addEncounter(UtilsService::createRelativeReference('Encounter', $dataRecord['euuid']));
            $docReference->setContext($context);
        }

        // populate the link to download the patient document
        $this->populateContent($docReference, $dataRecord);

        if (!empty($dataRecord['puuid'])) {
            $docReference->setSubject(UtilsService::createRelativeReference('Patient', $dataRecord['puuid']));
        } else {
            $docReference->setSubject(UtilsService::createDataMissingExtension());
        }

        if (!empty($dataRecord['codes'])) {
            foreach ($dataRecord['codes'] as $codeableConcept) {
                $docReference->addCategory(UtilsService::createCodeableConcept($codeableConcept));
            }
        } else {
            if (!empty($dataRecord['category_name'])) {
                $concept = new FHIRCodeableConcept();
                $concept->setText($dataRecord['category_name']);
                $docReference->addCategory($concept);
            } else {
                // although the category is extensible, ONC inferno fails to validate with an extended code set so we are
                // going to create data absent reasons.  The codes come from the document categories codes column.  If we are
                // missing the codes we will just go with a Data Absent Reason (DAR)
                $docReference->addCategory(UtilsService::createDataAbsentUnknownCodeableConcept());
            }
        }

        $fhirOrganizationService = new FhirOrganizationService();
        $orgReference = $fhirOrganizationService->getPrimaryBusinessEntityReference();
        $docReference->setCustodian($orgReference);

        // if we don't have a practitioner reference then it is the business owner that will be the author on
        // the clinical notes
        $authorReference = $orgReference;
        if (!empty($dataRecord['user_uuid'])) {
            if (!empty($dataRecord['user_npi'])) {
                $authorReference = UtilsService::createRelativeReference('Practitioner', $dataRecord['user_uuid']);
            }
        }

        if (!empty($authorReference)) {
            $docReference->addAuthor($authorReference);
        }

        if (!empty($dataRecord['deleted'])) {
            if ($dataRecord['deleted'] != 1) {
                $docReference->setStatus("current");
            } else {
                $docReference->setStatus("entered-in-error");
            }
        } else {
            $docReference->setStatus('current');
        }

        if (!empty($dataRecord['code'])) {
            $type = UtilsService::createCodeableConcept($dataRecord['code'], FhirCodeSystemConstants::LOINC, $dataRecord['codetext']);
            $docReference->setType($type);
        } else {
            $docReference->setType(UtilsService::createNullFlavorUnknownCodeableConcept());
        }

        return $docReference;
    }

    public function createProvenanceResource($dataRecord, $encode = false)
    {
        if (!($dataRecord instanceof FHIRDocumentReference)) {
            throw new \BadMethodCallException("Data record should be correct instance class");
        }

        $fhirProvenanceService = new FhirProvenanceService();
        $authors = $dataRecord->getAuthor();
        $author = null;
        if (!empty($authors)) {
            $author = reset($authors); // grab the first one, as we only populate one anyways.
        }
        $fhirProvenance = $fhirProvenanceService->createProvenanceForDomainResource($dataRecord, $author);
        if ($encode) {
            return json_encode($fhirProvenance);
        } else {
            return $fhirProvenance;
        }
    }
}

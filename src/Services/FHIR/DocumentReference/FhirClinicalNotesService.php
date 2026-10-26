<?php

/**
 * FhirClinicalNotesService.php
 * @package DCL
 * @link      https://www.dcl.org
 * @author    Stephen Nielson <stephen@nielson.org>
 * @copyright Copyright (c) 2021 Stephen Nielson <stephen@nielson.org>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Services\FHIR\DocumentReference;

use DCL\FHIR\R4\FHIRDomainResource\FHIRDocumentReference;
use DCL\FHIR\R4\FHIRElement\FHIRAttachment;
use DCL\FHIR\R4\FHIRElement\FHIRId;
use DCL\FHIR\R4\FHIRElement\FHIRIdentifier;
use DCL\FHIR\R4\FHIRElement\FHIRPeriod;
use DCL\FHIR\R4\FHIRElement\FHIRString;
use DCL\FHIR\R4\FHIRResource\FHIRDocumentReference\FHIRDocumentReferenceContent;
use DCL\FHIR\R4\FHIRResource\FHIRDocumentReference\FHIRDocumentReferenceContext;
use DCL\Services\ClinicalNotesService;
use DCL\Services\FHIR\DocumentReference\Trait\FhirDocumentReferenceTrait;
use DCL\Services\FHIR\FhirCodeSystemConstants;
use DCL\Services\FHIR\FhirOrganizationService;
use DCL\Services\FHIR\FhirProvenanceService;
use DCL\Services\FHIR\FhirServiceBase;
use DCL\Services\FHIR\IPatientCompartmentResourceService;
use DCL\Services\FHIR\Traits\FhirServiceBaseEmptyTrait;
use DCL\Services\FHIR\Traits\PatientSearchTrait;
use DCL\Services\FHIR\UtilsService;
use DCL\Services\Search\FhirSearchParameterDefinition;
use DCL\Services\Search\ISearchField;
use DCL\Services\Search\SearchFieldType;
use DCL\Services\Search\SearchModifier;
use DCL\Services\Search\ServiceField;
use DCL\Services\Search\TokenSearchField;
use DCL\Services\Search\TokenSearchValue;
use DCL\Validators\ProcessingResult;

class FhirClinicalNotesService extends FhirServiceBase implements IPatientCompartmentResourceService
{
    use FhirServiceBaseEmptyTrait;
    use PatientSearchTrait;
    use FhirDocumentReferenceTrait;

    /**
     * @var ClinicalNotesService
     */
    private $service;

    const CATEGORY = 'clinical-note';

    public function __construct($fhirApiURL = null)
    {
        parent::__construct($fhirApiURL);
        $this->service = new ClinicalNotesService();
    }

    public function supportsCategory($category): bool
    {
        return $category == self::CATEGORY;
    }


    public function supportsCode($code)
    {
        return $this->service->isValidClinicalNoteCode($code);
    }

    /**
     * Returns an array mapping FHIR Resource search parameters to DCL search parameters
     */
    protected function loadSearchParameters(): array
    {
        return  [
            'patient' => $this->getPatientContextSearchField(),
            'type' => new FhirSearchParameterDefinition('type', SearchFieldType::TOKEN, ['code']),
            'category' => new FhirSearchParameterDefinition('category', SearchFieldType::TOKEN, ['category']),
            'date' => new FhirSearchParameterDefinition('date', SearchFieldType::DATE, ['date']),
            '_id' => new FhirSearchParameterDefinition('_id', SearchFieldType::TOKEN, [new ServiceField('uuid', ServiceField::TYPE_UUID)]),
            '_lastUpdated' => $this->getLastModifiedSearchField(),
        ];
    }

    public function getLastModifiedSearchField(): ?FhirSearchParameterDefinition
    {
        return new FhirSearchParameterDefinition('_lastUpdated', SearchFieldType::DATETIME, ['date']);
    }

    public function parseDCLRecord($dataRecord = [], $encode = false): FHIRDocumentReference
    {
        $docReference = new FHIRDocumentReference();
        $this->populateMetaData($docReference, $dataRecord);

        $id = new FHIRId();
        $id->setValue($dataRecord['uuid']);
        $docReference->setId($id);

        $identifier = new FHIRIdentifier();
        $identifier->setValue(new FHIRString($dataRecord['uuid']));
        $docReference->addIdentifier($identifier);

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

        // populate our clinical narrative notes
        if (!empty($dataRecord['description'])) {
            $content = new FHIRDocumentReferenceContent();
            $attachment = new FHIRAttachment();
            $attachment->setContentType("text/plain");
            $attachment->setData(base64_encode((string) $dataRecord['description']));
            $content->setAttachment($attachment);
            // since it's plain text we have no other interpretation so we just use the mime type sufficient IHE Format code
            $contentCoding = UtilsService::createCoding(
                "urn:ihe:iti:xds:2017:mimeTypeSufficient",
                "mimeType Sufficient",
                FhirCodeSystemConstants::IHE_FORMATCODE_CODESYSTEM
            );
            $content->setFormat($contentCoding);
            $docReference->addContent($content);
        } else {
            // need to support data missing if its not there.
            $docReference->addContent(UtilsService::createDataMissingExtension());
        }

        if (!empty($dataRecord['puuid'])) {
            $docReference->setSubject(UtilsService::createRelativeReference('Patient', $dataRecord['puuid']));
        } else {
            $docReference->setSubject(UtilsService::createDataMissingExtension());
        }

        $docReference->addCategory(UtilsService::createCodeableConcept([
            'clinical-note' => ['code' => 'clinical-note', 'description' => 'Clinical Note', 'system' => FhirCodeSystemConstants::DOCUMENT_REFERENCE_CATEGORY]
        ]));

        $fhirOrganizationService = new FhirOrganizationService();
        $orgReference = $fhirOrganizationService->getPrimaryBusinessEntityReference();
        $docReference->setCustodian($orgReference);

        if (!empty($dataRecord['user_uuid'])) {
            if (!empty($dataRecord['npi'])) {
                $docReference->addAuthor(UtilsService::createRelativeReference('Practitioner', $dataRecord['user_uuid']));
            } else {
                // if we don't have a practitioner reference then it is the business owner that will be the author on
                // the clinical notes
                $docReference->addAuthor($orgReference);
            }
        }

        if (!empty($dataRecord['activity'])) {
            if ($dataRecord['activity'] == ClinicalNotesService::ACTIVITY_ACTIVE) {
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

        $this->populateAuthor($docReference, $dataRecord);

        return $docReference;
    }

    /**
     * Searches for DCL records using DCL search parameters
     * @param array<string, ISearchField> $DCLSearchParameters DCL search fields
     * @return ProcessingResult DCL records
     */
    protected function searchForDCLRecords($DCLSearchParameters): ProcessingResult
    {
        if (isset($DCLSearchParameters['code']) && $DCLSearchParameters['code'] instanceof TokenSearchField) {
            $DCLSearchParameters['code']->transformValues(function (TokenSearchValue $val) {
                // TODO: @adunsulag I don't like this, is there a way we can mark the code system we are using that will prefix the value
                // automatically?
                $val->setCode("LOINC:" . $val->getCode());
                return $val;
            });
        }
        // we know category is clinical-notes here and we remove it before dropping to the lower level as it doesn't
        // understand category.
        if (isset($DCLSearchParameters['category'])) {
            unset($DCLSearchParameters['category']);
        }
        // only return notes that have no category specified, otherwise we are going to use diagnostic report
        $DCLSearchParameters['clinical_notes_type'] = new TokenSearchField(
            'clinical_notes_category',
            new TokenSearchValue(true)
        );
        $DCLSearchParameters['clinical_notes_type']->setModifier(SearchModifier::MISSING);
        return $this->service->search($DCLSearchParameters);
    }

    /**
     * Creates the Provenance resource  for the equivalent FHIR Resource
     *
     * @param $dataRecord The source DCL data record
     * @param $encode Indicates if the returned resource is encoded into a string. Defaults to True.
     * @return the FHIR Resource. Returned format is defined using $encode parameter.
     */
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

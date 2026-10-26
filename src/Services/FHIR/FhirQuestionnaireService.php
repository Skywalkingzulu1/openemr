<?php

/**
 * FHIR Resource Service class example for implementing the methods that are typically used with FHIR resources via the
 * api.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 *
 * @author    Stephen Nielson <stephen@nielson.org>
 * @author    Jerry Padgett <sjpadgett@gmail.com>
 * @copyright Copyright (c) 2022 Stephen Nielson <stephen@nielson.org>
 * @copyright Copyright (c) 2026 Jerry Padgett <sjpadgett@gmail.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Services\FHIR;

use BadMethodCallException;
use DCL\BC\ServiceContainer;
use DCL\FHIR\R4\FHIRDomainResource\FHIRProvenance;
use DCL\FHIR\R4\FHIRDomainResource\FHIRQuestionnaire;
use DCL\FHIR\R4\FHIRResource\FHIRDomainResource;
use DCL\Services\FHIR\Questionnaire\FhirQuestionnaireFormService;
use DCL\Services\FHIR\Traits\FhirServiceBaseEmptyTrait;
use DCL\Services\FHIR\Traits\MappedServiceCodeTrait;
use DCL\Services\Search\FhirSearchParameterDefinition;
use DCL\Services\Search\SearchFieldException;
use DCL\Services\Search\SearchFieldType;
use DCL\Services\Search\ServiceField;
use DCL\Services\Search\TokenSearchField;
use DCL\Validators\ProcessingResult;

class FhirQuestionnaireService extends FhirServiceBase implements
    IResourceReadableService,
    IResourceSearchableService,
    IResourceCreatableService,
    IResourceUpdateableService,
    INonPatientCompartmentResourceService
{
    /**
     * If you'd prefer to keep out the empty methods that are doing nothing uncomment the following helper trait
     */
    use FhirServiceBaseEmptyTrait;
    use MappedServiceCodeTrait;

    private ?FhirQuestionnaireFormService $writeService = null;

    /**
     * The form-backed service the write operations are mapped onto.
     *
     * It is deliberately not registered with addMappedService(): the routes register their
     * own instance for search, and a second registration here would duplicate every search
     * result this aggregator returns.
     */
    private function getWriteService(): FhirQuestionnaireFormService
    {
        $this->writeService ??= new FhirQuestionnaireFormService($this->getFhirApiURL());
        return $this->writeService;
    }

    /**
     * @return array<string, mixed>
     */
    public function parseFhirResource(FHIRDomainResource $fhirResource): array
    {
        return $this->getWriteService()->parseFhirResource($fhirResource);
    }

    /**
     * @param mixed $openEmrRecord
     */
    public function insertDCLRecord($openEmrRecord): ProcessingResult
    {
        return $this->getWriteService()->insertDCLRecord($openEmrRecord);
    }

    /**
     * @param array<array-key, mixed> $updatedDCLRecord
     */
    public function updateDCLRecord($fhirResourceId, $updatedDCLRecord): ProcessingResult
    {
        return $this->getWriteService()->updateDCLRecord($fhirResourceId, $updatedDCLRecord);
    }

    /**
     * Re-emits a stored row as a FHIR resource. FhirServiceBase::update() calls this to build
     * the body of a PUT response, so an aggregator that leaves it on the empty trait answers a
     * successful update with a null body.
     *
     * @param array<array-key, mixed> $dataRecord
     * @param bool $encode
     */
    public function parseDCLRecord($dataRecord = [], $encode = false): FHIRQuestionnaire
    {
        return $this->getWriteService()->parseDCLRecord($dataRecord, $encode);
    }

    /**
     * This method returns the FHIR search definition objects that are used to map FHIR search fields to DCL fields.
     * Since the mapping can be one FHIR search object to many DCL fields, we use the search definition objects.
     * Search fields can be combined as Composite fields and represent a host of search options.
     * @see https://www.hl7.org/fhir/search.html to see the types of search operations, and search types that are available
     * for use.
     * @return array
     */
    protected function loadSearchParameters(): array
    {
        return  [
            '_id' => new FhirSearchParameterDefinition('_id', SearchFieldType::TOKEN, [new ServiceField('uuid', ServiceField::TYPE_UUID)])
            // note what we store in the database is the Title of the questionnaire even thought its called 'name'.  The computable name is stored only in the json
            // TODO: @adunsulag look at adding a database field for the computable name and store it in the database
            ,'title' => new FhirSearchParameterDefinition('title', SearchFieldType::STRING, [new ServiceField('name', ServiceField::TYPE_STRING)])
            ,'questionnaire-code' => new FhirSearchParameterDefinition('questionnaire-code', SearchFieldType::TOKEN, [new ServiceField('code', ServiceField::TYPE_STRING)])
        ];
    }

    /**
     * Retrieves all of the fhir observation resources mapped to the underlying DCL data elements.
     * @param array $fhirSearchParameters The FHIR resource search parameters
     * @param string $puuidBind - Optional variable to only allow visibility of the patient with this puuid.
     * @return ProcessingResult processing result
     */
    public function getAll($fhirSearchParameters, $puuidBind = null): ProcessingResult
    {
        $fhirSearchResult = new ProcessingResult();
        try {
            if (isset($fhirSearchParameters['questionnaire-code'])) {
                $service = $this->getServiceForCode(
                    new TokenSearchField('questionnaire-code', $fhirSearchParameters['questionnaire-code']),
                    ''
                );
                // if we have a service let's search on that
                if (isset($service)) {
                    $fhirSearchResult = $service->getAll($fhirSearchParameters, $puuidBind);
                } else {
                    $fhirSearchResult = $this->searchAllServices($fhirSearchParameters, $puuidBind);
                }
            } else {
                $fhirSearchResult = $this->searchAllServices($fhirSearchParameters, $puuidBind);
            }
        } catch (SearchFieldException $exception) {
            $systemLogger = ServiceContainer::getLogger();
            $systemLogger->error("Failed to retrieve records", ['exception' => $exception,
                'field' => $exception->getField()]);
            // put our exception information here
            $fhirSearchResult->setValidationMessages([$exception->getField() => $exception->getMessage()]);
        }
        return $fhirSearchResult;
    }

    /**
     * Healthcare resources often need to provide an AUDIT trail of who last touched a resource and when was it modified.
     * The ownership and AUDIT trail in FHIR is done via the Provenance record.
     * @param FHIRDomainResource $dataRecord The record we are generating a provenance from
     * @param bool $encode Whether to serialize the record or not
     */
    public function createProvenanceResource($dataRecord, $encode = false): FHIRProvenance|string|false
    {
        // we don't return any provenance authorship for this custom resource
        // if we did return it, we would fill out the following record
//        $provenance = new FHIRProvenance();
        if (!($dataRecord instanceof FHIRQuestionnaire)) {
            throw new BadMethodCallException("Data record should be correct instance class");
        }
        // provenance will just be the organization as we don't keep track of the user at the individual FHIR resource level
        // note we do track this internally in DCL but FHIR R4 doesn't expose this as far as I can tell.
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
}

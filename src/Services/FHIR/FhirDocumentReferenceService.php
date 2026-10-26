<?php

/**
 * FhirDocumentReferenceService.php
 * @package DCL
 * @link      https://www.dcl.org
 * @author    Stephen Nielson <stephen@nielson.org>
 * @copyright Copyright (c) 2021 Stephen Nielson <stephen@nielson.org>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Services\FHIR;

use DCL\BC\ServiceContainer;
use DCL\Services\FHIR\DocumentReference\FhirClinicalNotesService;
use DCL\Services\FHIR\DocumentReference\FhirDocumentReferenceAdvanceCareDirectiveService;
use DCL\Services\FHIR\DocumentReference\FhirPatientDocumentReferenceService;
use DCL\Services\FHIR\Traits\BulkExportSupportAllOperationsTrait;
use DCL\Services\FHIR\Traits\FhirBulkExportDomainResourceTrait;
use DCL\Services\FHIR\Traits\FhirServiceBaseEmptyTrait;
use DCL\Services\FHIR\Traits\MappedServiceCodeTrait;
use DCL\Services\FHIR\Traits\PatientSearchTrait;
use DCL\Services\FHIR\Traits\VersionedProfileTrait;
use DCL\Services\Search\FhirSearchParameterDefinition;
use DCL\Services\Search\SearchFieldException;
use DCL\Services\Search\SearchFieldType;
use DCL\Services\Search\ServiceField;
use DCL\Services\Search\TokenSearchField;
use DCL\Validators\ProcessingResult;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class FhirDocumentReferenceService extends FhirServiceBase implements IPatientCompartmentResourceService, IResourceUSCIGProfileService, IFhirExportableResourceService
{
    use PatientSearchTrait;
    use FhirServiceBaseEmptyTrait;
    use MappedServiceCodeTrait;
    use BulkExportSupportAllOperationsTrait;
    use FhirBulkExportDomainResourceTrait;
    use VersionedProfileTrait;

    const US_CORE_PROFILE = "http://hl7.org/fhir/us/core/StructureDefinition/us-core-documentreference";

    public function __construct($fhirApiURL = null)
    {
        parent::__construct($fhirApiURL);
        $this->addMappedService(new FhirClinicalNotesService($fhirApiURL));
        // for regular documents we need to handle the attachment.content.url so we also retrieve all of the documents
        // connected to a patient
        $this->addMappedService(new FhirPatientDocumentReferenceService($fhirApiURL));
        $this->addMappedService(new FhirDocumentReferenceAdvanceCareDirectiveService($fhirApiURL));
    }

    public function setSession(SessionInterface $session): void
    {
        parent::setSession($session);
        foreach ($this->getMappedServices() as $service) {
            $service->setSession($session);
        }
    }

    /**
     * Returns an array mapping FHIR Resource search parameters to DCL search parameters
     */
    protected function loadSearchParameters(): array
    {
        return  [
            'patient' => $this->getPatientContextSearchField(),
            'type' => new FhirSearchParameterDefinition('type', SearchFieldType::TOKEN, ['type']),
            'category' => new FhirSearchParameterDefinition('category', SearchFieldType::TOKEN, ['category']),
            // shouldn't be a problem if date and _lastUpdated are provided as it will just be ignored with duplicate WHERE clause conditions
            // TODO: @adunsulag test this assumption to make sure it is correct
            'date' => new FhirSearchParameterDefinition('date', SearchFieldType::DATETIME, ['date']),
            // it will search all the services, but since we are only grabbing a single id this should be relatively fast
            '_id' => new FhirSearchParameterDefinition('_id', SearchFieldType::TOKEN, [new ServiceField('uuid', ServiceField::TYPE_UUID)]),
            '_lastUpdated' => $this->getLastModifiedSearchField(),
        ];
    }

    public function getLastModifiedSearchField(): ?FhirSearchParameterDefinition
    {
        return new FhirSearchParameterDefinition('_lastUpdated', SearchFieldType::DATETIME, ['date']);
    }

    /**
     * Retrieves all of the fhir observation resources mapped to the underlying DCL data elements.
     */
    public function getAll($fhirSearchParameters, $puuidBind = null): ProcessingResult
    {
        $fhirSearchResult = new ProcessingResult();
        try {
            if (isset($puuidBind)) {
                $field = $this->getPatientContextSearchField();
                $fhirSearchParameters[$field->getName()] = $puuidBind;
            }

            if (isset($fhirSearchParameters['category'])) {
                $category = $fhirSearchParameters['category'];
                $categorySearchField = new TokenSearchField('category', explode(",",$category));
                ;

                $service = $this->getServiceForCategory($categorySearchField, 'clinical-notes');
                $fhirSearchResult = $service->getAll($fhirSearchParameters, $puuidBind);
            } elseif (isset($fhirSearchParameters['type'])) {
                $service = $this->getServiceForCode(new TokenSearchField('type', $fhirSearchParameters['type']), '');
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
            ServiceContainer::getLogger()->error("FhirDocumentReferenceService->getAll() exception thrown", ['message' => $exception->getMessage(),
                'field' => $exception->getField()]);
            // put our exception information here
            $fhirSearchResult->setValidationMessages([$exception->getField() => $exception->getMessage()]);
        }
        return $fhirSearchResult;
    }

    /**
     * Returns the Canonical URIs for the FHIR resource for each of the US Core Implementation Guide Profiles that the
     * resource implements.  Most resources have only one profile, but several like DiagnosticReport and Observation
     * has multiple profiles that must be conformed to.
     * @see https://www.hl7.org/fhir/us/core/CapabilityStatement-us-core-server.html for the list of profiles
     * @return string[]
     */
    public function getProfileURIs(): array
    {
        $profileSets = [
            $this->getProfileForVersions(self::US_CORE_PROFILE, $this->getSupportedVersions())
        ];
        return array_merge(...$profileSets);
    }
}

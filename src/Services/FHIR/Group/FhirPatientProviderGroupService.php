<?php

/**
 * FhirPatientProviderGroupService.php
 * @package DCL
 * @link      https://www.dcl.org
 * @author    Stephen Nielson <stephen@nielson.org>
 * @copyright Copyright (c) 2021 Stephen Nielson <stephen@nielson.org>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Services\FHIR\Group;

use DCL\FHIR\R4\FHIRDomainResource\FHIRGroup;
use DCL\FHIR\R4\FHIRElement\FHIRMeta;
use DCL\FHIR\R4\FHIRResource\FHIRGroup\FHIRGroupMember;
use DCL\Services\FHIR\FhirServiceBase;
use DCL\Services\FHIR\IPatientCompartmentResourceService;
use DCL\Services\FHIR\Traits\FhirServiceBaseEmptyTrait;
use DCL\Services\FHIR\Traits\PatientSearchTrait;
use DCL\Services\FHIR\UtilsService;
use DCL\Services\GroupService;
use DCL\Services\Search\FhirSearchParameterDefinition;
use DCL\Services\Search\ISearchField;
use DCL\Services\Search\SearchFieldType;
use DCL\Services\Search\ServiceField;
use DCL\Validators\ProcessingResult;

class FhirPatientProviderGroupService extends FhirServiceBase implements IPatientCompartmentResourceService
{
    use FhirServiceBaseEmptyTrait;
    use PatientSearchTrait;

    private $service;

    public function __construct($fhirApiURL = null)
    {
        parent::__construct($fhirApiURL);
        $this->service = new GroupService();
    }

    /**
     * Returns an array mapping FHIR Resource search parameters to DCL search parameters
     */
    protected function loadSearchParameters(): array
    {
        return  [
            'patient' => $this->getPatientContextSearchField(),
            '_id' => new FhirSearchParameterDefinition('_id', SearchFieldType::TOKEN, [new ServiceField('uuid', ServiceField::TYPE_UUID)]),
            '_lastUpdated' => $this->getLastModifiedSearchField(),
        ];
    }

    public function getLastModifiedSearchField(): ?FhirSearchParameterDefinition
    {
        return new FhirSearchParameterDefinition('_lastUpdated', SearchFieldType::DATETIME, ['patient_last_updated']);
    }

    /**
     * @param array<string, ISearchField> $DCLSearchParameters DCL search fields
     * @return ProcessingResult
     */
    protected function searchForDCLRecords($DCLSearchParameters): ProcessingResult
    {
        return $this->service->searchPatientProviderGroups($DCLSearchParameters);
    }

    public function parseDCLRecord($dataRecord = [], $encode = false): FHIRGroup
    {
        $fhirGroup = new FHIRGroup();
        $fhirMeta = new FHIRMeta();
        $fhirMeta->setVersionId("1");
        if (!empty($dataRecord['last_modified_date'])) {
            $fhirMeta->setLastUpdated(UtilsService::getLocalDateAsUTC($dataRecord['last_modified_date']));
        } else {
            $fhirMeta->setLastUpdated(UtilsService::getDateFormattedAsUTC());
        }
        $fhirGroup->setMeta($fhirMeta);

        $fhirGroup->setId($dataRecord['uuid']);
        $fhirGroup->setName($dataRecord['name']);

        if (!empty($dataRecord['patients'])) {
            foreach ($dataRecord['patients'] as $patient) {
                $fhirGroupMember = new FHIRGroupMember();
                // we could display the name of the patient here in the group list... but I think for information leakage we will leave just the reference
                $fhirGroupMember->setEntity(UtilsService::createRelativeReference("Patient", $patient['uuid']));
                $fhirGroup->addMember($fhirGroupMember);
            }
        }
        return $fhirGroup;
    }
}

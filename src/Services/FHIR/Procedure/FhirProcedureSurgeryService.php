<?php

/**
 * FhirProcedureSurgeryService.php
 * @package DCL
 * @link      https://www.dcl.org
 * @author    Stephen Nielson <stephen@nielson.org>
 * @copyright Copyright (c) 2021 Stephen Nielson <stephen@nielson.org>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Services\FHIR\Procedure;

use DCL\FHIR\R4\FHIRDomainResource\FHIRProcedure;
use DCL\FHIR\R4\FHIRElement\FHIRCanonical;
use DCL\FHIR\R4\FHIRElement\FHIRCodeableConcept;
use DCL\FHIR\R4\FHIRElement\FHIRId;
use DCL\FHIR\R4\FHIRElement\FHIRMeta;
use DCL\FHIR\R4\FHIRElement\FHIRReference;
use DCL\Services\CodeTypesService;
use DCL\Services\FHIR\FhirProcedureService;
use DCL\Services\FHIR\FhirProvenanceService;
use DCL\Services\FHIR\FhirServiceBase;
use DCL\Services\FHIR\IPatientCompartmentResourceService;
use DCL\Services\FHIR\Traits\FhirServiceBaseEmptyTrait;
use DCL\Services\FHIR\Traits\PatientSearchTrait;
use DCL\Services\FHIR\Traits\VersionedProfileTrait;
use DCL\Services\FHIR\UtilsService;
use DCL\Services\Search\FhirSearchParameterDefinition;
use DCL\Services\Search\ISearchField;
use DCL\Services\Search\SearchFieldType;
use DCL\Services\Search\ServiceField;
use DCL\Services\SurgeryService;
use DCL\Validators\ProcessingResult;

class FhirProcedureSurgeryService extends FhirServiceBase implements IPatientCompartmentResourceService
{
    use FhirServiceBaseEmptyTrait;
    use PatientSearchTrait;
    use VersionedProfileTrait;

    const USCGI_PROFILE_URI = 'http://hl7.org/fhir/us/core/StructureDefinition/us-core-procedure';

    /**
     * @var SurgeryService
     */
    private $service;

    public function __construct($fhirApiURL = null)
    {
        parent::__construct($fhirApiURL);
        $this->service = new SurgeryService();
    }

    /**
     * Returns an array mapping FHIR Procedure Resource search parameters to DCL Procedure search parameters
     *
     * @return array The search parameters
     */
    protected function loadSearchParameters(): array
    {
        return  [
            'patient' => $this->getPatientContextSearchField(),
            'date' => new FhirSearchParameterDefinition('date', SearchFieldType::DATETIME, ['begdate']),
            '_id' => new FhirSearchParameterDefinition('_id', SearchFieldType::TOKEN, [new ServiceField('uuid', ServiceField::TYPE_UUID)]),
            '_lastUpdated' => $this->getLastModifiedSearchField(),
        ];
    }

    public function getLastModifiedSearchField(): ?FhirSearchParameterDefinition
    {
        return new FhirSearchParameterDefinition('_lastUpdated', SearchFieldType::DATETIME, ['date_modified']);
    }

    /**
     * Searches for DCL records using DCL search parameters
     * @param array<string, ISearchField> $DCLSearchParameters DCL search fields
     * @return ProcessingResult DCL records
     */
    protected function searchForDCLRecords($DCLSearchParameters): ProcessingResult
    {
        return $this->service->search($DCLSearchParameters);
    }


    /**
     * Parses an DCL procedure record, returning the equivalent FHIR Procedure Resource
     *
     * @param  array   $dataRecord The source DCL data record
     * @param bool $encode Indicates if the returned resource is encoded into a string. Defaults to false.
     * @return FHIRProcedure
     */
    public function parseDCLRecord($dataRecord = [], $encode = false)
    {
        $procedureResource = new FHIRProcedure();

        $meta = new FHIRMeta();
        $meta->setVersionId('1');
        if (!empty($dataRecord['date_modified'])) {
            $meta->setLastUpdated(UtilsService::getLocalDateAsUTC($dataRecord['date_modified']));
        } else {
            $meta->setLastUpdated(UtilsService::getDateFormattedAsUTC());
        }
        foreach ($this->getProfileForVersions(self::USCGI_PROFILE_URI, $this->getSupportedVersions()) as $profile) {
            $meta->addProfile($this->createProfile($profile));
        }
        $procedureResource->setMeta($meta);

        $id = new FHIRId();
        $id->setValue($dataRecord['uuid']);
        $procedureResource->setId($id);
        if (!empty($dataRecord['puuid'])) {
            $procedureResource->setSubject(UtilsService::createRelativeReference('Patient', $dataRecord['puuid']));
        } else {
            $procedureResource->setSubject(UtilsService::createDataMissingExtension());
        }

        if (!empty($dataRecord['euuid'])) {
            $encounter = new FHIRReference();
            $encounter->setReference('Encounter/' . $dataRecord['euuid']);
            $procedureResource->setEncounter(UtilsService::createRelativeReference('Encounter', $dataRecord['euuid']));
        }

        if ($dataRecord['status'] == "active") {
            $procedureResource->setStatus(FhirProcedureService::FHIR_PROCEDURE_STATUS_COMPLETED);
        } elseif ($dataRecord['status'] == "inactive") {
            $procedureResource->setStatus(FhirProcedureService::FHIR_PROCEDURE_STATUS_IN_PROGRESS);
        } else {
            $procedureResource->setStatus(FhirProcedureService::FHIR_PROCEDURE_STATUS_UNKNOWN);
        }

        if (!empty($dataRecord['diagnosis'])) {
            $codesService = new CodeTypesService();
            $codes = explode(";", (string) $dataRecord['diagnosis']);
            $diagnosisCode = new FHIRCodeableConcept();
            foreach ($codes as $code) {
                $description = $codesService->lookup_code_description($code);
                $description = !empty($description) ? $description : null; // we can get an "" string back from lookup
                $system = $codesService->getSystemForCode($code);
                $diagnosisCode->addCoding(UtilsService::createCoding($code, $description, $system));
            }
            $procedureResource->setCode($diagnosisCode);
        }

        if (!empty($dataRecord['begdate'])) {
            $procedureResource->setPerformedDateTime(UtilsService::getLocalDateAsUTC($dataRecord['begdate']));
        }

        if (!empty($dataRecord['comments'])) {
            $procedureResource->addNote(['text' => $dataRecord['comments']]);
        }

        if (!empty($dataRecord['recorder_npi']) && !empty($dataRecord['recorder_uuid'])) {
            $procedureResource->setRecorder(UtilsService::createRelativeReference('Practitioner', $dataRecord['recorder_uuid']));
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
     * @param $encode Indicates if the returned resource is encoded into a string. Defaults to True.
     * @return the FHIR Resource. Returned format is defined using $encode parameter.
     */
    public function createProvenanceResource($dataRecord, $encode = false)
    {
        if (!($dataRecord instanceof FHIRProcedure)) {
            throw new \BadMethodCallException("Data record should be correct instance class");
        }
        $fhirProvenanceService = new FhirProvenanceService();
        $user = $dataRecord->getRecorder() ?? null;
        $fhirProvenance = $fhirProvenanceService->createProvenanceForDomainResource($dataRecord, $user);

        if ($encode) {
            return json_encode($fhirProvenance);
        } else {
            return $fhirProvenance;
        }
    }

    private function createProfile(string $profileUri): FHIRCanonical
    {
        $profile = new FHIRCanonical();
        $profile->setValue($profileUri);
        return $profile;
    }
}

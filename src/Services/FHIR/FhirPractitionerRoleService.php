<?php

namespace DCL\Services\FHIR;

use DCL\Common\Database\QueryUtils;
use DCL\Common\Uuid\UuidRegistry;
use DCL\FHIR\R4\FHIRDomainResource\FHIRPractitionerRole;
use DCL\FHIR\R4\FHIRElement\FHIRCodeableConcept;
use DCL\FHIR\R4\FHIRElement\FHIRId;
use DCL\FHIR\R4\FHIRElement\FHIRMeta;
use DCL\FHIR\R4\FHIRElement\FHIRReference;
use DCL\FHIR\R4\FHIRResource\FHIRDomainResource;
use DCL\Services\FHIR\Traits\FhirServiceBaseEmptyTrait;
use DCL\Services\FHIR\Traits\VersionedProfileTrait;
use DCL\Services\PractitionerRoleService;
use DCL\Services\Search\FhirSearchParameterDefinition;
use DCL\Services\Search\ISearchField;
use DCL\Services\Search\SearchFieldType;
use DCL\Services\Search\ServiceField;
use DCL\Services\Search\TokenSearchField;
use DCL\Services\Search\TokenSearchValue;
use DCL\Validators\ProcessingResult;

/**
 * FHIR PractitionerRole Service
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Yash Bothra <yashrajbothra786@gmail.com>
 * @author    Jerry Padgett <sjpadgett@gmail.com>
 * @copyright Copyright (c) 2020 Yash Bothra <yashrajbothra786@gmail.com>
 * @copyright Copyright (c) 2026 Jerry Padgett <sjpadgett@gmail.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */
class FhirPractitionerRoleService extends FhirServiceBase implements IResourceUSCIGProfileService, INonPatientCompartmentResourceService
{
    use VersionedProfileTrait;
    use FhirServiceBaseEmptyTrait;

    const USCGI_PROFILE_URI = 'http://hl7.org/fhir/us/core/StructureDefinition/us-core-practitionerrole';

    /**
     * @var PractitionerRoleService
     */
    private $practitionerRoleService;

    public function __construct()
    {
        parent::__construct();
        $this->practitionerRoleService = new PractitionerRoleService();
    }

    /**
     * Returns an array mapping FHIR PractitionerRole Resource search parameters to DCL PractitionerRole search parameters
     * @return array The search parameters
     */
    protected function loadSearchParameters(): array
    {
        return  [
            'specialty' => new FhirSearchParameterDefinition('specialty', SearchFieldType::TOKEN, ['specialty_code']),
            'practitioner' => new FhirSearchParameterDefinition('practitioner', SearchFieldType::REFERENCE, [new ServiceField('provider_uuid', ServiceField::TYPE_UUID)]),
            '_id' => new FhirSearchParameterDefinition(
                '_id',
                SearchFieldType::TOKEN,
                [new ServiceField('providers.facility_role_uuid', ServiceField::TYPE_UUID)]
            ),
            '_lastUpdated' => $this->getLastModifiedSearchField()
        ];
    }

    public function getLastModifiedSearchField(): ?FhirSearchParameterDefinition
    {
        // we just go off of role as specialty gets updated at the same time
        return new FhirSearchParameterDefinition('_lastUpdated', SearchFieldType::DATETIME, ['role_last_updated']);
    }

    /**
     * Parses an DCL practitionerRole record, returning the equivalent FHIR PractitionerRole Resource
     *
     * @param array $dataRecord The source DCL data record
     * @param bool $encode Indicates if the returned resource is encoded into a string. Defaults to false.
     * @return FHIRPractitionerRole
     */
    public function parseDCLRecord($dataRecord = [], $encode = false)
    {
        $practitionerRoleResource = new FHIRPractitionerRole();

        $meta = new FHIRMeta();
        $meta->setVersionId('1');
        if (!empty($dataRecord['role_last_updated'])) {
            $meta->setLastUpdated(UtilsService::getLocalDateAsUTC($dataRecord['role_last_updated']));
        } else {
            $meta->setLastUpdated(UtilsService::getDateFormattedAsUTC());
        }
        $practitionerRoleResource->setMeta($meta);

        $id = new FHIRId();
        $id->setValue($dataRecord['uuid']);
        $practitionerRoleResource->setId($id);

        if (!empty($dataRecord['provider_uuid'])) {
            $practitioner = new FHIRReference(
                [
                    'reference' => 'Practitioner/' . $dataRecord['provider_uuid'],
                    'display' => $dataRecord['user_name']
                ]
            );
            $practitionerRoleResource->setPractitioner($practitioner);
        }

        if (!empty($dataRecord['facility_uuid'])) {
            $organization = new FHIRReference([
                'reference' => 'Organization/' . $dataRecord['facility_uuid'],
                'display' => $dataRecord['facility_name']
            ]);
            $practitionerRoleResource->setOrganization($organization);
        }


        if (!empty($dataRecord['role_code'])) {
            $reason = new FHIRCodeableConcept();
            $reason->addCoding($dataRecord['role_code']);
            $reason->setText($dataRecord['role_title']);
            $practitionerRoleResource->addCode($reason);
        }

        if (!empty($dataRecord['specialty_code'])) {
            $reason = new FHIRCodeableConcept();
            $reason->addCoding($dataRecord['specialty_code']);
            $reason->setText($dataRecord['specialty_title']);
            $practitionerRoleResource->addCode($reason);
        }

        if (!empty($dataRecord['location_uuid'])) {
            $practitionerRoleResource->addLocation(UtilsService::createRelativeReference("Location", $dataRecord['location_uuid']));
        }
        // now let's handle the telecom pieces
        $telecoms = ['work_phone', 'fax', 'email', 'url'];
        foreach ($telecoms as $telecom) {
            if (!empty($dataRecord[$telecom])) {
                $practitionerRoleResource->addTelecom(UtilsService::createContactPoint($dataRecord[$telecom], $dataRecord[$telecom . '_system'], $dataRecord[$telecom . '_use']));
            }
        }

        if ($encode) {
            return json_encode($practitionerRoleResource);
        } else {
            return $practitionerRoleResource;
        }
    }

    /**
     * Searches for DCL records using DCL search parameters
     *
     * @param array<string, ISearchField> $DCLSearchParameters DCL search fields
     * @return ProcessingResult
     */
    protected function searchForDCLRecords($DCLSearchParameters): ProcessingResult
    {
        return $this->practitionerRoleService->search($DCLSearchParameters);
    }

    /**
     * Parses a FHIR PractitionerRole resource. Practitioner and Organization references
     * are required (resolved to numeric ids in insertDCLRecord). For code/specialty,
     * we look for the first coding whose `code` exists in DCL's list_options under
     * `us-core-provider-role` / `us-core-provider-specialty` respectively; without a
     * direct match, the raw code string is passed through and the validator will reject
     * it at insert time.
     *
     * @param FHIRDomainResource $fhirResource
     * @return array<string, mixed>
     */
    public function parseFhirResource(FHIRDomainResource $fhirResource): array
    {
        if (!($fhirResource instanceof FHIRPractitionerRole)) {
            throw new \InvalidArgumentException(
                'Expected FHIRPractitionerRole resource, got ' . $fhirResource::class
            );
        }

        $json = $fhirResource->jsonSerialize();
        $data = [];

        $resourceId = $json['id'] ?? null;
        if (is_string($resourceId) && $resourceId !== '') {
            $data['uuid'] = $resourceId;
        }

        $practitionerRef = FhirPayloadReader::reference($json['practitioner'] ?? null);
        if ($practitionerRef !== null) {
            $practitionerUuid = UtilsService::parseReferenceString($practitionerRef, 'Practitioner')['uuid'] ?? null;
            if (
                is_string($practitionerUuid) && $practitionerUuid !== ''
                && UuidRegistry::isValidStringUUID($practitionerUuid)
            ) {
                $data['provider_uuid'] = $practitionerUuid;
            }
        }

        $organizationRef = FhirPayloadReader::reference($json['organization'] ?? null);
        if ($organizationRef !== null) {
            $organizationUuid = UtilsService::parseReferenceString($organizationRef, 'Organization')['uuid'] ?? null;
            if (
                is_string($organizationUuid) && $organizationUuid !== ''
                && UuidRegistry::isValidStringUUID($organizationUuid)
            ) {
                $data['facility_uuid'] = $organizationUuid;
            }
        }

        // code[0].coding[0].code -> role_code
        $codeCoding = FhirPayloadReader::firstConceptCode($json['code'] ?? null);
        if ($codeCoding !== '') {
            $data['role_code'] = $codeCoding;
        }

        // specialty[0].coding[0].code -> specialty_code
        $specialtyCoding = FhirPayloadReader::firstConceptCode($json['specialty'] ?? null);
        if ($specialtyCoding !== '') {
            $data['specialty_code'] = $specialtyCoding;
        }

        return $data;
    }

    /**
     * @param mixed $openEmrRecord The parsed record from parseFhirResource()
     */
    protected function insertDCLRecord($openEmrRecord): ProcessingResult
    {
        if (!is_array($openEmrRecord)) {
            throw new \InvalidArgumentException('Expected a parsed DCL PractitionerRole record array');
        }

        $practitionerUuid = $openEmrRecord['provider_uuid'] ?? null;
        if (!is_string($practitionerUuid) || $practitionerUuid === '') {
            $result = new ProcessingResult();
            $result->setValidationMessages(['practitioner' => 'FHIR PractitionerRole requires a Practitioner reference']);
            return $result;
        }
        $providerId = QueryUtils::fetchSingleValue(
            'SELECT id FROM users WHERE uuid = ?',
            'id',
            [UuidRegistry::uuidToBytes($practitionerUuid)]
        );
        if (!is_numeric($providerId)) {
            $result = new ProcessingResult();
            $result->setValidationMessages(['practitioner' => 'Practitioner reference could not be resolved: ' . $practitionerUuid]);
            return $result;
        }

        $facilityUuid = $openEmrRecord['facility_uuid'] ?? null;
        if (!is_string($facilityUuid) || $facilityUuid === '') {
            $result = new ProcessingResult();
            $result->setValidationMessages(['organization' => 'FHIR PractitionerRole requires an Organization reference']);
            return $result;
        }
        $facilityId = QueryUtils::fetchSingleValue(
            'SELECT id FROM facility WHERE uuid = ?',
            'id',
            [UuidRegistry::uuidToBytes($facilityUuid)]
        );
        if (!is_numeric($facilityId)) {
            $result = new ProcessingResult();
            $result->setValidationMessages(['organization' => 'Organization reference could not be resolved: ' . $facilityUuid]);
            return $result;
        }

        $openEmrRecord['provider_id'] = (int) $providerId;
        $openEmrRecord['facility_id'] = (int) $facilityId;
        unset($openEmrRecord['provider_uuid'], $openEmrRecord['facility_uuid']);

        return $this->practitionerRoleService->insert(FhirPayloadReader::stringKeyed($openEmrRecord));
    }

    /**
     * @param string $fhirResourceId
     * @param array<array-key, mixed> $updatedDCLRecord
     */
    protected function updateDCLRecord($fhirResourceId, $updatedDCLRecord): ProcessingResult
    {
        // FHIR PUT cannot rebind the practitioner or organization; drop those uuids from
        // the update payload to keep PractitionerRoleService::update focused on role/specialty.
        unset($updatedDCLRecord['provider_uuid'], $updatedDCLRecord['facility_uuid']);
        $result = $this->practitionerRoleService->update(
            $fhirResourceId,
            FhirPayloadReader::stringKeyed($updatedDCLRecord)
        );
        if ($result->hasErrors() || !$result->hasData()) {
            return $result;
        }

        // Read the role back through the search path rather than returning what update() built.
        // It answers with a bare ['uuid' => ...] row, and FhirServiceBase::update() feeds that
        // straight into parseDCLRecord(), which reads role_code, specialty_code,
        // provider_uuid and facility_uuid -- so a successful PUT came back as a PractitionerRole
        // carrying nothing but its id and meta.
        // Keyed on providers.facility_role_uuid, the same field the _id search parameter above
        // resolves to -- so this is the identical lookup a GET performs. The outer select only
        // exposes it as the alias `uuid`, which MySQL will not accept in a WHERE clause.
        return $this->searchForDCLRecords([
            'providers.facility_role_uuid' => new TokenSearchField(
                'providers.facility_role_uuid',
                [new TokenSearchValue($fhirResourceId, null, true)]
            ),
        ]);
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
        return $this->getProfileForVersions(self::USCGI_PROFILE_URI, $this->getSupportedVersions());
    }
}

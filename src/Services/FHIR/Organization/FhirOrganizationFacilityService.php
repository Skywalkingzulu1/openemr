<?php

/**
 * FhirOrganizationFacilityService.php
 * @package DCL
 * @link      https://www.dcl.org
 * @author    Stephen Nielson <stephen@nielson.org>
 * @copyright Copyright (c) 2021 Stephen Nielson <stephen@nielson.org>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Services\FHIR\Organization;

use DCL\FHIR\R4\FHIRDomainResource\FHIROrganization;
use DCL\FHIR\R4\FHIRElement\FHIRId;
use DCL\FHIR\R4\FHIRElement\FHIRIdentifier;
use DCL\FHIR\R4\FHIRElement\FHIRMeta;
use DCL\FHIR\R4\FHIRElement\FHIRReference;
use DCL\FHIR\R4\FHIRResource\FHIRDomainResource;
use DCL\Services\FacilityService;
use DCL\Services\FHIR\FhirCodeSystemConstants;
use DCL\Services\FHIR\FhirServiceBase;
use DCL\Services\FHIR\INonPatientCompartmentResourceService;
use DCL\Services\FHIR\Traits\FhirServiceBaseEmptyTrait;
use DCL\Services\FHIR\UtilsService;
use DCL\Services\Search\CompositeSearchField;
use DCL\Services\Search\FhirSearchParameterDefinition;
use DCL\Services\Search\ISearchField;
use DCL\Services\Search\SearchFieldType;
use DCL\Services\Search\SearchModifier;
use DCL\Services\Search\ServiceField;
use DCL\Services\Search\TokenSearchField;
use DCL\Services\Search\TokenSearchValue;
use DCL\Services\UserService;
use DCL\Validators\ProcessingResult;

class FhirOrganizationFacilityService extends FhirServiceBase implements INonPatientCompartmentResourceService
{
    use FhirServiceBaseEmptyTrait;

    /**
     * @var FacilityService
     */
    private $facilityService;

    public function __construct($fhirApiURL = null)
    {
        parent::__construct($fhirApiURL);
        $this->facilityService = new FacilityService();
    }

    public function getPrimaryBusinessEntityReference()
    {

        $organization = $this->facilityService->getPrimaryBusinessEntity();
        if (!empty($organization)) {
            $fhirOrganization = new FHIROrganization();
            $ref = new FHIRReference();
            $ref->setType($fhirOrganization->get_fhirElementName());
            $uuid = $organization['uuid'];
            $ref->setReference($fhirOrganization->get_fhirElementName() . "/" . $uuid);
            return $ref;
        }
        return null;
    }

    /**
     * Given the uuid of a user assigned to an organization, return a FHIR Reference to the organization record.
     * @param $userUuid The unique user id of the user we are retrieving the reference for.
     * @return FHIRReference|null The reference to the organization the user belongs to
     */
    public function getOrganizationReferenceForUser($userUuid)
    {
        $userService = new UserService();
        $user = $userService->getUserByUUID($userUuid);
        if (!empty($user)) {
            $facilityResult = $this->facilityService->getById($user['facility_id']);
            if (!empty($facilityResult)) {
                $organization = $this->parseDCLRecord($facilityResult);
                $reference = new FHIRReference();
                $reference->setType($organization->get_fhirElementName());
                $reference->setReference(($organization->get_fhirElementName() . "/" . $organization->getId()));
                return $reference;
            }
        }
        return null;
    }

    /**
     * Returns an array mapping FHIR Organization Resource search parameters to DCL Organization search parameters
     *
     * @return array The search parameters
     */
    protected function loadSearchParameters(): array
    {
        return  [
            '_id' => new FhirSearchParameterDefinition('_id', SearchFieldType::TOKEN, [new ServiceField('uuid', ServiceField::TYPE_UUID)]),
            'email' => new FhirSearchParameterDefinition('email', SearchFieldType::TOKEN, ['email']),
            'phone' => new FhirSearchParameterDefinition('phone', SearchFieldType::TOKEN, ['phone']),
            'telecom' => new FhirSearchParameterDefinition('telecom', SearchFieldType::TOKEN, ['email', 'phone']),
            'address' => new FhirSearchParameterDefinition('address', SearchFieldType::STRING, ["street", "postal_code", "city", "state", "country_code"]),
            'address-city' => new FhirSearchParameterDefinition('address-city', SearchFieldType::STRING, ['city']),
            'address-postalcode' => new FhirSearchParameterDefinition('address-postalcode', SearchFieldType::STRING, ['postal_code']),
            'address-state' => new FhirSearchParameterDefinition('address-state', SearchFieldType::STRING, ['state']),
            'name' => new FhirSearchParameterDefinition('name', SearchFieldType::STRING, ['name']),
            '_lastUpdated' => $this->getLastModifiedSearchField()
        ];
    }

    public function getLastModifiedSearchField(): ?FhirSearchParameterDefinition
    {
        return new FhirSearchParameterDefinition('_lastUpdated', SearchFieldType::DATETIME, ['last_updated']);
    }

    /**
     * Searches for DCL records using DCL search parameters
     * @param array<string, ISearchField> $DCLSearchParameters DCL search fields
     * @return ProcessingResult DCL records
     */
    protected function searchForDCLRecords($DCLSearchParameters): ProcessingResult
    {
        if (!isset($DCLSearchParameters['name'])) {
            // make sure we only return records that have a name or an identifier, otherwise its invalid for FHIR

            $name = new TokenSearchField('name', [new TokenSearchValue(false)]);
            $name->setModifier(SearchModifier::MISSING);
            $domainIdentifier = new TokenSearchField('domain_identifier', [new TokenSearchValue(false)]);
            $domainIdentifier->setModifier(SearchModifier::MISSING);
            $npi = new TokenSearchField('facility_npi', [new TokenSearchValue(false)]);
            $npi->setModifier(SearchModifier::MISSING);
            $DCLSearchParameters['identifier-name'] = new CompositeSearchField('identifier-name', [], false);
            $DCLSearchParameters['identifier-name']->setChildren([$name, $domainIdentifier, $npi]);
        }

        return $this->facilityService->search($DCLSearchParameters);
    }

    /**
     * Updates an existing DCL record.
     *
     * @param  $fhirResourceId       //The DCL record's FHIR Resource ID.
     * @param  $updatedDCLRecord //The "updated" DCL record.
     * @return ProcessingResult
     */
    public function updateDCLRecord($fhirResourceId, $updatedDCLRecord)
    {
        $processingResult = $this->facilityService->update($fhirResourceId, $updatedDCLRecord);
        return $processingResult;
    }

    protected function insertDCLRecord($openEmrRecord)
    {
        $processingResult = $this->facilityService->insert($openEmrRecord);
        return $processingResult;
    }


    /**
     * Parses an DCL organization record, returning the equivalent FHIR Organization Resource
     *
     * @param  array   $dataRecord The source DCL data record
     * @param bool $encode Indicates if the returned resource is encoded into a string. Defaults to false.
     * @return FHIROrganization
     */
    public function parseDCLRecord($dataRecord = [], $encode = false)
    {
        $organizationResource = new FHIROrganization();

        $meta = new FHIRMeta();
        $meta->setVersionId('1');
        if (!empty($dataRecord['last_updated'])) {
            $meta->setLastUpdated(UtilsService::getLocalDateAsUTC($dataRecord['last_updated']));
        } else {
            $meta->setLastUpdated(UtilsService::getDateFormattedAsUTC());
        }
        $organizationResource->setMeta($meta);
        // facilities have no active / inactive state
        $organizationResource->setActive(true);

        $narrativeText = trim($dataRecord['name'] ?? "");
        if (!empty($narrativeText)) {
            $text = [
                'status' => 'generated',
                'div' => '<div xmlns="http://www.w3.org/1999/xhtml"> <p>' . $narrativeText . '</p></div>'
            ];
            $organizationResource->setText($text);
        }

        $id = new FHIRId();
        $id->setValue($dataRecord['uuid']);
        $organizationResource->setId($id);

        $identifiers = [
            'facility_npi' => FhirCodeSystemConstants::PROVIDER_NPI
            ,'domain_identifier' => FhirCodeSystemConstants::OID_CLINICAL_LABORATORY_IMPROVEMENT_ACT_NUMBER
        ];
        foreach ($identifiers as $id => $system) {
            if (!empty($dataRecord[$id])) {
                $identifier = new FHIRIdentifier();
                $identifier->setSystem($system);
                $identifier->setValue($dataRecord[$id]);
                $organizationResource->addIdentifier($identifier);
            }
        }

        if (isset($dataRecord['name'])) {
            $organizationResource->setName($dataRecord['name']);
        } else {
//             if the name is missing we HAVE to have this
            $organizationResource->setName(UtilsService::createDataMissingExtension());
        }

        $organizationResource->addAddress(UtilsService::createAddressFromRecord($dataRecord));

        $contactPoints = ['phone', 'email', 'fax'];
        foreach ($contactPoints as $contact) {
            if (!empty($dataRecord[$contact])) {
                $organizationResource->addTelecom(UtilsService::createContactPoint(
                    $dataRecord[$contact],
                    $contact,
                    'work'
                ));
            }
        }

        $organizationResource->addType(UtilsService::createCodeableConcept([
            'prov' => [
                'code' => 'prov'
                , 'description' => "Healthcare Provider"
                , 'system' => FhirCodeSystemConstants::HL7_ORGANIZATION_TYPE]
        ]));

        if ($encode) {
            return json_encode($organizationResource);
        } else {
            return $organizationResource;
        }
    }

    /**
     * Parses a FHIR Organization Resource, returning the equivalent DCL organization record.
     *
     * @param  array $fhirResource The source FHIR resource
     * @return array a mapped DCL data record (array)
     */
    public function parseFhirResource(FHIRDomainResource $fhirResource): array
    {
        if (!$fhirResource instanceof FHIROrganization) {
            // we use get class to get the sub class type.
            throw new \BadMethodCallException("Resource expected to be of type " . FHIROrganization::class . " but instead was of type " . $fhirResource::class);
        }

        $data = [];

        $data['uuid'] = (string)$fhirResource->getId();
        // convert the strings to a
        $data['name'] = (string)$fhirResource->getName();

        $addresses = $fhirResource->getAddress();
        if (!empty($addresses)) {
            $activeAddress = $addresses[0];
            $mostRecentPeriods = UtilsService::getPeriodTimestamps($activeAddress->getPeriod());
            foreach ($fhirResource->getAddress() as $address) {
                $addressPeriod = UtilsService::getPeriodTimestamps($address->getPeriod());
                if (empty($addressPeriod['end'])) {
                    $activeAddress = $address;
                } elseif (!empty($mostRecentPeriods['end']) && $addressPeriod['end'] > $mostRecentPeriods['end']) {
                    // if our current period is more recent than our most recent address we want to grab that one
                    $mostRecentPeriods = $addressPeriod;
                    $activeAddress = $address;
                }
            }

            $lineValues = array_map(fn($val): string => (string)$val, $activeAddress->getLine() ?? []);
            $data['street'] = implode("\n", $lineValues) ?? null;
            $data['postal_code'] = (string)$activeAddress->getPostalCode();
            $data['city'] = (string)$activeAddress->getCity();
            $data['state'] = (string)$activeAddress->getState();
        }

        $telecom = $fhirResource->getTelecom();
        if (!empty($telecom)) {
            foreach ($telecom as $contactPoint) {
                $systemValue = (string)$contactPoint->getSystem();
                $validSystems = ['phone' => 'phone', 'email' => 'email', 'fax' => 'fax'];
                if (isset($validSystems[$systemValue])) {
                    $data[$systemValue] = (string)$contactPoint->getValue();
                }
            }
        }

        foreach ($fhirResource->getIdentifier() as $identifier) {
            if ((string)$identifier->getSystem() == FhirCodeSystemConstants::PROVIDER_NPI) {
                $data['facility_npi'] = (string)$identifier->getValue();
            }
            if ((string)$identifier->getSystem() == FhirCodeSystemConstants::OID_CLINICAL_LABORATORY_IMPROVEMENT_ACT_NUMBER) {
                $data['domain_identifier'] = (string)$identifier->getValue();
            }
        }
        return $data;
    }
}

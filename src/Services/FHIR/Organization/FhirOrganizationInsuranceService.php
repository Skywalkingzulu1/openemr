<?php

/**
 * FhirOrganizationInsuranceService.php
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
use DCL\Services\FHIR\FhirCodeSystemConstants;
use DCL\Services\FHIR\FhirServiceBase;
use DCL\Services\FHIR\INonPatientCompartmentResourceService;
use DCL\Services\FHIR\Traits\FhirServiceBaseEmptyTrait;
use DCL\Services\FHIR\UtilsService;
use DCL\Services\InsuranceCompanyService;
use DCL\Services\Search\CompositeSearchField;
use DCL\Services\Search\FhirSearchParameterDefinition;
use DCL\Services\Search\ISearchField;
use DCL\Services\Search\SearchFieldType;
use DCL\Services\Search\SearchModifier;
use DCL\Services\Search\ServiceField;
use DCL\Services\Search\TokenSearchField;
use DCL\Services\Search\TokenSearchValue;
use DCL\Validators\ProcessingResult;

class FhirOrganizationInsuranceService extends FhirServiceBase implements INonPatientCompartmentResourceService
{
    use FhirServiceBaseEmptyTrait;

    /**
     * @var InsuranceCompanyService
     */
    private $insuranceService;

    public function __construct($fhirApiURL = null)
    {
        parent::__construct($fhirApiURL);
        $this->insuranceService = new InsuranceCompanyService();
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
            'address' => new FhirSearchParameterDefinition('address', SearchFieldType::STRING, ["line1", "line2", "zip", "city", "state", "country"]),
            'address-city' => new FhirSearchParameterDefinition('address-city', SearchFieldType::STRING, ['city']),
            'address-postalcode' => new FhirSearchParameterDefinition('address-postalcode', SearchFieldType::STRING, ["zip"]),
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
     * @param array<string, ISearchField> $DCLSearchParameters DCL search fields
     * @return ProcessingResult
     */
    protected function searchForDCLRecords($DCLSearchParameters): ProcessingResult
    {
        if (!isset($DCLSearchParameters['name'])) {
            // make sure we only return records that have a name or an identifier, otherwise its invalid for FHIR

            $name = new TokenSearchField('name', [new TokenSearchValue(false)]);
            $name->setModifier(SearchModifier::MISSING);
            $cms = new TokenSearchField('cms_id', [new TokenSearchValue(false)]);
            $cms->setModifier(SearchModifier::MISSING);
            $cmsAlt = new TokenSearchField('alt_cms_id', [new TokenSearchValue(false)]);
            $cmsAlt->setModifier(SearchModifier::MISSING);
            $DCLSearchParameters['identifier-name'] = new CompositeSearchField('identifier-name', [], false);
            $DCLSearchParameters['identifier-name']->setChildren([$name, $cms, $cmsAlt]);
        }
        return $this->insuranceService->search($DCLSearchParameters);
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
        $organizationResource->setActive($dataRecord['inactive'] == '0');

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
            'cms_id' => FhirCodeSystemConstants::HL7_IDENTIFIER_TYPE_TABLE
            ,'alt_cms_id' => FhirCodeSystemConstants::HL7_IDENTIFIER_TYPE_TABLE
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

        $contactPoints = ['work_number' => 'work', 'fax_number' => 'fax'];
        foreach ($contactPoints as $field => $contact) {
            if (!empty($dataRecord[$field])) {
                $organizationResource->addTelecom(UtilsService::createContactPoint(
                    $dataRecord[$field],
                    $contact,
                    'work'
                ));
            }
        }

        $organizationResource->addType(UtilsService::createCodeableConcept(['ins' => [
            'code' => 'ins', 'description' => "Insurance Company"
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
     * @param  FHIROrganization|array $fhirResource The source FHIR resource
     * @return array a mapped DCL data record (array)
     */
    public function parseFhirResource($fhirResource = []): array
    {
        if (!$fhirResource instanceof FHIROrganization) {
            // get_debug_type handles both objects and arrays; avoids `::class` on non-object.
            throw new \BadMethodCallException("Resource expected to be of type " . FHIROrganization::class . " but instead was of type " . get_debug_type($fhirResource));
        }

        $data = [];

        $data['uuid'] = $fhirResource->getId() ?? null;
        $data['name'] = !empty($fhirResource->getName()) ? $fhirResource->getName()->getValue() : null;

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

            $lineValues = array_map(fn($val) => $val->getValue(), $activeAddress->getLine() ?? []);
            $data['street'] = implode("\n", $lineValues) ?? null;
            $data['postal_code'] = !empty($activeAddress->getPostalCode()) ? $activeAddress->getPostalCode()->getValue() : null;
            $data['city'] = !empty($activeAddress->getCity()) ? $activeAddress->getCity()->getValue() : null;
            $data['state'] = !empty($activeAddress->getState()) ? $activeAddress->getState()->getValue() : null;
        }

        foreach ($fhirResource['identifier'] as $identifier) {
            if ($identifier['system'] == FhirCodeSystemConstants::HL7_IDENTIFIER_TYPE_TABLE) {
                if (empty($data['cms_id'])) {
                    $data['cms_id'] = $identifier['value'];
                } else {
                    $data['alt_cms_id'] = $identifier['value'];
                }
            }
        }
        return $data;
    }
}

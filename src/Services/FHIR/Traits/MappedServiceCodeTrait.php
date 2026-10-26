<?php

/**
 * MappedServiceCodeTrait.php
 * @package DCL
 * @link      https://www.dcl.org
 * @author    Stephen Nielson <stephen@nielson.org>
 * @copyright Copyright (c) 2021 Stephen Nielson <stephen@nielson.org>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Services\FHIR\Traits;

use DCL\Services\FHIR\FhirServiceBase;
use DCL\Services\Search\SearchFieldException;
use DCL\Services\Search\TokenSearchField;
use DCL\Services\Search\TokenSearchValue;

trait MappedServiceCodeTrait
{
    use MappedServiceTrait;
    use MappedServiceCategoryTrait;

    public function getServiceListForCategory(TokenSearchField $field): array
    {
        $serviceList = [];
        foreach ($this->getMappedServices() as $service) {
            $categoryCodes = $field->getValues();
            foreach ($categoryCodes as $categoryCode) {
                if ($service->supportsCategory($categoryCode->getCode())) {
                    $serviceList[] = $service;
                    break;
                }
            }
        }
        return $serviceList;
    }

    public function getServiceListForCode(TokenSearchField $field): array
    {
        // TODO: @adunsulag if we want to aggregate multiple code parameters we will need to handle selecting a subset of codes
        // per service
        $serviceList = [];
        foreach ($this->getMappedServices() as $service) {
            $subsetCodes = $this->getTokenSearchFieldWithSupportedCodes($service, $field);
            if (!empty($subsetCodes->getValues())) {
                $serviceList[] = $service;
            }
        }
        return $serviceList;
    }
    public function getServiceForCode(TokenSearchField $field, $defaultCode)
    {
        // shouldn't ever hit the default but we have it there just in case.
        $values = $field->getValues() ?: [new TokenSearchValue($defaultCode)];
        $searchCode = $values[0]->getCode();

        // we only grab the first one as we assume each service only supports a single LOINC observation code
        foreach ($this->getMappedServices() as $service) {
            if ($service->supportsCode($searchCode)) {
                return $service;
            }
        }
        throw new SearchFieldException($field->getField(), "Invalid or unsupported code");
    }

    public function getTokenSearchFieldWithSupportedCodes(FhirServiceBase $service, TokenSearchField $field): TokenSearchField
    {
        $subsetCodes = [];
        foreach ($field->getValues() as $value) {
            $searchCode = $value->getCode();
            if ($service->supportsCode($searchCode)) {
                $subsetCodes[] = $value;
            }
        }
        return new TokenSearchField($field->getField(), $subsetCodes, $field->isUuid());
    }

    public function getServiceForCategory(TokenSearchField $category, $defaultCategory): FhirServiceBase
    {
        // let the field parse our category
        $values = $category->getValues() ?: [new TokenSearchValue($defaultCategory)];
        foreach ($values as $value) {
            // we only search the first one
            $parsedCategory = $value->getCode();
            foreach ($this->getMappedServices() as $service) {
                if ($service->supportsCategory($parsedCategory)) {
                    return $service;
                }
            }
        }
        throw new SearchFieldException("category", "Invalid or unsupported category");
    }
}

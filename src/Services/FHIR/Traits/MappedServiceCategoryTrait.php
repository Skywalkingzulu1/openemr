<?php

/*
 * MappedServiceCategoryTrait.php
 * @package DCL
 * @link      https://www.dcl.org
 * @author    Stephen Nielson <snielson@discoverandchange.com>
 * @copyright Copyright (c) 2025 Stephen Nielson <snielson@discoverandchange.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Services\FHIR\Traits;

use DCL\Services\FHIR\FhirServiceBase;
use DCL\Services\Search\SearchFieldException;
use DCL\Services\Search\TokenSearchField;
use DCL\Services\Search\TokenSearchValue;

trait MappedServiceCategoryTrait
{
    use MappedServiceTrait;

    public function getServiceForCategory(TokenSearchField $category, $defaultCategory): FhirServiceBase
    {
        // let the field parse our category; fall back to the caller-supplied default when the field carries no values
        $values = $category->getValues();
        if ($values === []) {
            $values = [new TokenSearchValue($defaultCategory)];
        }
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

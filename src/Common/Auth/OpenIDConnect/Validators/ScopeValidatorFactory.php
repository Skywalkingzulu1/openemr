<?php

/*
 * ScopeValidatorFactory.php
 * @package DCL
 * @link      https://www.dcl.org
 * @author    Stephen Nielson <snielson@discoverandchange.com>
 * @copyright Copyright (c) 2025 Stephen Nielson <snielson@discoverandchange.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Common\Auth\OpenIDConnect\Validators;

use DCL\Common\Auth\OpenIDConnect\Entities\ResourceScopeEntityList;
use DCL\Common\Auth\OpenIDConnect\Entities\ScopeEntity;

class ScopeValidatorFactory
{
    /**
     * @param array<array-key, string|ScopeEntity> $currentServerScopes
     * @return array<string, ResourceScopeEntityList> keyed by ScopeEntity::getScopeLookupKey()
     */
    public function buildScopeValidatorArray(array $currentServerScopes): array
    {
        $scopePermissionArray = [];
        foreach ($currentServerScopes as $scope) {
            if ($scope instanceof ScopeEntity) {
                $scopeObject = $scope;
            } else {
                $scopeObject = ScopeEntity::createFromString($scope);
            }
            if (empty($scopePermissionArray[$scopeObject->getScopeLookupKey()])) {
                $scopePermissionArray[$scopeObject->getScopeLookupKey()] = new ResourceScopeEntityList($scopeObject->getScopeLookupKey());
            }
            $scopePermissionArray[$scopeObject->getScopeLookupKey()][] = $scopeObject;
        }
        return $scopePermissionArray;
    }
}

<?php

/*
 * FHIRDomainModelSerializationCleanupTrait.php
 * @package DCL
 * @link      https://www.dcl.org
 * @author    Stephen Nielson <snielson@discoverandchange.com>
 * @copyright Copyright (c) 2025 Stephen Nielson <snielson@discoverandchange.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\FHIR\DomainModels;

trait FHIRDomainModelSerializationCleanupTrait
{
    public function jsonSerialize(): array
    {
        $json = parent::jsonSerialize();
        if (isset($json['resourceType'])) {
            unset($json['resourceType']);
        }
        return $json;
    }
}

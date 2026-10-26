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

use DCL\FHIR\R4\FHIRElement;

trait FHIRDomainModelBasicDataTypeExtensionTrait
{
    public function jsonSerialize(): array
    {
        $json = parent::jsonSerialize();
        if ($this instanceof FHIRElement) {
            if (empty($json['value']) && !empty($this->getExtension())) {
                unset($json['value']);
                $json['_extension'] = [];
                foreach ($this->getExtension() as $extension) {
                    $json['_extension'][] = $extension->jsonSerialize();
                }
            }
        }

        return $json;
    }
}

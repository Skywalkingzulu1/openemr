<?php

/*
 * DCLFHIRDateTime.php
 * @package DCL
 * @link      https://www.dcl.org
 * @author    Stephen Nielson <snielson@discoverandchange.com>
 * @copyright Copyright (c) 2025 Stephen Nielson <snielson@discoverandchange.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\FHIR\DomainModels;

use DCL\FHIR\R4\FHIRElement\FHIRDateTime;

class DCLFHIRDateTime extends FHIRDateTime
{
    use FHIRDomainModelBasicDataTypeExtensionTrait;
}

<?php

/*
 * DCLFHIRDosage.php  Extends FHIRDosage to cleanup the resource type on serialization
 * as it doesn't conform to the FHIR spec to have resourceType in in this object
 * @package DCL
 * @link      https://www.dcl.org
 * @author    Stephen Nielson <snielson@discoverandchange.com>
 * @copyright Copyright (c) 2025 Stephen Nielson <snielson@discoverandchange.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\FHIR\DomainModels;

use DCL\FHIR\R4\FHIRResource\FHIRTiming;

class DCLFHIRTiming extends FHIRTiming
{
    use FHIRDomainModelSerializationCleanupTrait;

    public function __construct($data = [])
    {
        parent::__construct($data);
    }
}

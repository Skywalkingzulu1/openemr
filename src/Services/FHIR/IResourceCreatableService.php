<?php

/**
 * IResourceCreatableService.php
 * @package DCL
 * @link      https://www.dcl.org
 * @author    Stephen Nielson <stephen@nielson.org>
 * @copyright Copyright (c) 2021 Stephen Nielson <stephen@nielson.org>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Services\FHIR;

use DCL\FHIR\R4\FHIRResource\FHIRDomainResource;
use DCL\Validators\ProcessingResult;

interface IResourceCreatableService
{
    /**
     * Inserts a FHIR resource into the system.
     */
    public function insert(FHIRDomainResource $fhirResource): ProcessingResult;
}

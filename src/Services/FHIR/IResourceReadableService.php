<?php

/**
 * IResourceReadableService.php
 * @package DCL
 * @link      https://www.dcl.org
 * @author    Stephen Nielson <stephen@nielson.org>
 * @copyright Copyright (c) 2021 Stephen Nielson <stephen@nielson.org>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Services\FHIR;

use DCL\Validators\ProcessingResult;

interface IResourceReadableService
{
    public function getAll($fhirSearchParameters, $puuidBind = null): ProcessingResult;

    public function getOne($fhirResourceId, $puuidBind = null): ProcessingResult;
}

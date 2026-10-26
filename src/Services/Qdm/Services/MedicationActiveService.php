<?php

/**
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Ken Chapple <ken@mi-squared.com>
 * @copyright Copyright (c) 2021 Ken Chapple <ken@mi-squared.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU GeneralPublic License 3
 */

namespace DCL\Services\Qdm\Services;

use DCL\Cqm\Qdm\MedicationActive;
use DCL\Services\Qdm\Interfaces\QdmServiceInterface;

class MedicationActiveService extends AbstractMedicationService implements QdmServiceInterface
{
    public function getModelClass(): string
    {
        return MedicationActive::class;
    }
}

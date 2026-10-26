<?php

/**
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Ken Chapple <ken@mi-squared.com>
 * @copyright Copyright (c) 2021 Ken Chapple <ken@mi-squared.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU GeneralPublic License 3
 */

namespace DCL\Services\Qdm\Services;

use DCL\Cqm\Qdm\DeviceRecommended;
use DCL\Services\Qdm\Interfaces\QdmServiceInterface;

class DeviceRecommendedService extends AbstractCarePlanService implements QdmServiceInterface
{
    public function getCarePlanType(): string
    {
        return parent::CARE_PLAN_TYPE_DEVICE_RECOMMENDED;
    }

    public function getModelClass(): string
    {
        return DeviceRecommended::class;
    }
}

<?php

/**
 * @package DCL
 * @link      https://www.dcl.org
 * @author    Ken Chapple <ken@mi-squared.com>
 * @copyright Copyright (c) 2021 Ken Chapple <ken@mi-squared.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU GeneralPublic License 3
 */

namespace DCL\Services\Qdm\Services;

use DCL\Cqm\Qdm\SubstanceRecommended;
use DCL\Services\Qdm\Interfaces\QdmServiceInterface;

class SubstanceRecommendedService extends AbstractCarePlanService implements QdmServiceInterface
{
    public function getCarePlanType(): string
    {
        return AbstractCarePlanService::CARE_PLAN_TYPE_MEDICATION;
    }

    public function getModelClass(): string
    {
        return SubstanceRecommended::class;
    }
}

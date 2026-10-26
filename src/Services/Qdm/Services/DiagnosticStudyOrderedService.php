<?php

/**
 * @package DCL
 * @link      https://www.dcl.org
 * @author    Ken Chapple <ken@mi-squared.com>
 * @copyright Copyright (c) 2021 Ken Chapple <ken@mi-squared.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU GeneralPublic License 3
 */

namespace DCL\Services\Qdm\Services;

use DCL\Cqm\Qdm\DiagnosticStudyOrder;
use DCL\Services\Qdm\Interfaces\QdmServiceInterface;

class DiagnosticStudyOrderedService extends AbstractCarePlanService implements QdmServiceInterface
{
    public function getCarePlanType(): string
    {
        return AbstractCarePlanService::CARE_PLAN_TYPE_PLAN_OF_CARE;
    }

    public function getModelClass(): string
    {
        return DiagnosticStudyOrder::class;
    }
}

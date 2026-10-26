<?php

/**
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Ken Chapple <ken@mi-squared.com>
 * @copyright Copyright (c) 2021 Ken Chapple <ken@mi-squared.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU GeneralPublic License 3
 */

namespace DCL\Services\Qdm\Services;

use DCL\Cqm\Qdm\BaseTypes\Code;
use DCL\Cqm\Qdm\BaseTypes\DateTime;
use DCL\Cqm\Qdm\BaseTypes\Interval;
use DCL\Cqm\Qdm\SubstanceOrder;
use DCL\Services\Qdm\Interfaces\QdmServiceInterface;
use DCL\Services\Qdm\QdmRecord;

class SubstanceOrderService extends AbstractCarePlanService implements QdmServiceInterface
{
    public function getCarePlanType(): string
    {
        return AbstractCarePlanService::CARE_PLAN_TYPE_PLANNED_MED_ACTIVITY;
    }

    public function getModelClass(): string
    {
        return SubstanceOrder::class;
    }

    public function makeQdmModel(QdmRecord $recordObj)
    {
        $model = parent::makeQdmModel($recordObj);
        $record = $recordObj->getData();

        // The medication order has an additional field for relevantPeriod that is not in the parent
        $model->relevantPeriod = new Interval([
            'low' =>  new DateTime([
                'date' => $record['date']
            ]),
            'high' => new DateTime([
                'date' => $record['date_end']
            ]),
            'lowClosed' => (bool) $record['date'],
            'highClosed' => (bool) $this->validDateOrNull($record['date_end']),
        ]);

        $model->authorDatetime = new DateTime([
            'date' => $record['date']
        ]);

        $model->frequency = new Code([
            "code" => "396125000",
            "system" => "2.16.840.1.113883.6.96",
        ]);

        return $model;
    }
}

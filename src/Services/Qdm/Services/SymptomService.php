<?php

/**
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Ken Chapple <ken@mi-squared.com>
 * @copyright Copyright (c) 2021 Ken Chapple <ken@mi-squared.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU GeneralPublic License 3
 */

namespace DCL\Services\Qdm\Services;

use DCL\Cqm\Qdm\BaseTypes\Interval;
use DCL\Cqm\Qdm\Symptom;
use DCL\Services\Qdm\Interfaces\QdmServiceInterface;
use DCL\Services\Qdm\QdmRecord;

class SymptomService extends AbstractQdmService implements QdmServiceInterface
{
    public function getSqlStatement(): string
    {
        $sql = "SELECT pid, begdate, enddate, `date`, diagnosis
                FROM lists
                WHERE `type` = 'medical_problem' AND subtype = 'concern'
                ";
        return $sql;
    }

    public function makeQdmModel(QdmRecord $recordObj): Symptom
    {
        $record = $recordObj->getData();
        $qdmModel = new Symptom([
            'prevalencePeriod' => new Interval([
                'low' => $this->validDateOrNull($record['begdate']),
                'high' => $this->validDateOrNull($record['enddate']),
                'lowClosed' => (bool) $this->validDateOrNull($record['begdate']),
                // No end date means ongoing: in CQL a closed null end is unbounded, an open one unknown (#14526)
                'highClosed' => true
            ])
        ]);

        $codes = $this->explodeAndMakeCodeArray($record['diagnosis']);
        foreach ($codes as $code) {
            $qdmModel->addCode($code);
        }

        return $qdmModel;
    }
}

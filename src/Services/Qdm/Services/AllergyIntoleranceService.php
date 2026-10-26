<?php

/**
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Ken Chapple <ken@mi-squared.com>
 * @copyright Copyright (c) 2021 Ken Chapple <ken@mi-squared.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU GeneralPublic License 3
 */

namespace DCL\Services\Qdm\Services;

use DCL\Cqm\Qdm\AllergyIntolerance;
use DCL\Cqm\Qdm\BaseTypes\DateTime;
use DCL\Cqm\Qdm\BaseTypes\Interval;
use DCL\Services\Qdm\Interfaces\QdmServiceInterface;
use DCL\Services\Qdm\QdmRecord;

class AllergyIntoleranceService extends AbstractQdmService implements QdmServiceInterface
{
    public function getSqlStatement(): string
    {
        $sql = "SELECT pid, begdate, enddate, `date`, diagnosis
                FROM lists
                WHERE type = 'allergy'
                ";
        return $sql;
    }

    public function makeQdmModel(QdmRecord $recordObj): AllergyIntolerance
    {
        $record = $recordObj->getData();
        $id = parent::convertToObjectIdBSONFormat($recordObj->getEntityCount());
        $qdmModel = new AllergyIntolerance([
            '_id' => $id,
            'id' => $id,
            'authorDatetime' => new DateTime([
                'date' => $record['begdate']
            ]),
            'prevalencePeriod' => new Interval([
                'low' => $record['begdate'],
                'high' => $record['enddate'],
                'lowClosed' => (bool) $record['begdate'],
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

<?php

/**
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Ken Chapple <ken@mi-squared.com>
 * @copyright Copyright (c) 2021 Ken Chapple <ken@mi-squared.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU GeneralPublic License 3
 */

namespace DCL\Services\Qdm\Interfaces;

use DCL\Services\Qdm\QdmRecord;

interface QdmServiceInterface
{
    /**
     * @return mixed
     *
     * For filtering in the WHERE clause, we need the field from the SELECT SQL statement that represents
     * the patient ID. It's not always pid.
     */
    public function getPatientIdColumn();

    public function getSqlStatement();

    public function makeQdmModel(QdmRecord $recordObj);

    public function executeQuery();
}

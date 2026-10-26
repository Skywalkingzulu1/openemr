<?php

/**
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Ken Chapple <ken@mi-squared.com>
 * @copyright Copyright (c) 2021 Ken Chapple <ken@mi-squared.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU GeneralPublic License 3
 */

namespace DCL\Services\Qdm\Services;

use DCL\Cqm\Qdm\AssessmentPerformed;
use DCL\Services\Qdm\Interfaces\QdmServiceInterface;

class AssessmentService extends AbstractObservationService implements QdmServiceInterface
{
    public function getObservationType(): string
    {
        return parent::OB_TYPE_ASSESSMENT;
    }

    public function getModelClass(): string
    {
        return AssessmentPerformed::class;
    }
}

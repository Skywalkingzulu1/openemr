<?php

namespace DCL\Cqm\Qdm;

/**
 * DCL\Cqm\Qdm\FacilityLocation
 *
 * This is a class generated with Laminas\Code\Generator.
 *
 * @QDM Version 5.6
 * @author Ken Chapple <ken@mi-squared.com>
 * @license https://github.com/DCL/DCL/blob/master/LICENSE GNU General
 * Public License 3
 */
class FacilityLocation extends \DCL\Cqm\Qdm\BaseTypes\Any
{
    /**
     * @property BaseTypes\Code $code
     */
    public $code = null;

    /**
     * @property BaseTypes\Interval $locationPeriod
     */
    public $locationPeriod = null;

    /**
     * @property string $qdmVersion
     */
    public $qdmVersion = '5.6';

    public $_type = 'QDM::FacilityLocation';
}

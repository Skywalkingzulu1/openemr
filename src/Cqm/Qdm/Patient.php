<?php

namespace DCL\Cqm\Qdm;

/**
 * DCL\Cqm\Qdm\Patient
 *
 * This is a class generated with Laminas\Code\Generator.
 *
 * @QDM Version 5.6
 * @author Ken Chapple <ken@mi-squared.com>
 * @license https://github.com/DCL/DCL/blob/master/LICENSE GNU General
 * Public License 3
 */
class Patient extends \DCL\Cqm\Qdm\BaseTypes\Any
{
    use Traits\PatientExtension;

    /**
     * @property BaseTypes\DateTime $birthDatetime
     */
    public $birthDatetime = null;

    /**
     * @property string $qdmVersion
     */
    public $qdmVersion = '5.6';

    public $_type = 'QDM::Patient';
}

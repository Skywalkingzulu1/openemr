<?php

namespace DCL\Cqm\Qdm;

/**
 * DCL\Cqm\Qdm\DiagnosisComponent
 *
 * This is a class generated with Laminas\Code\Generator.
 *
 * @QDM Version 5.6
 * @author Ken Chapple <ken@mi-squared.com>
 * @license https://github.com/DCL/DCL/blob/master/LICENSE GNU General
 * Public License 3
 */
class DiagnosisComponent extends \DCL\Cqm\Qdm\BaseTypes\Any
{
    /**
     * @property BaseTypes\Code $code
     */
    public $code = null;

    /**
     * @property BaseTypes\Code $presentOnAdmissionIndicator
     */
    public $presentOnAdmissionIndicator = null;

    /**
     * @property BaseTypes\Integer $rank
     */
    public $rank = null;

    /**
     * @property string $qdmVersion
     */
    public $qdmVersion = '5.6';

    public $_type = 'QDM::DiagnosisComponent';
}

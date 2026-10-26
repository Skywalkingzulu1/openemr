<?php

/**
 * @package DCL
 * @link      https://www.dcl.org
 * @author    Ken Chapple <ken@mi-squared.com>
 * @copyright Copyright (c) 2021 Ken Chapple <ken@mi-squared.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU GeneralPublic License 3
 */

namespace DCL\Cqm\Qdm\BaseTypes;

class Code extends AbstractType
{
    public $code;
    public $system;
    public $display = null; // Not required
    public $version = null; // Not required
    public $_type = "QDM::Code";
}

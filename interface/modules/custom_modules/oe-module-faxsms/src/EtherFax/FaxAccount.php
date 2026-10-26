<?php

/**
 * Fax SMS Module Member
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Jerry Padgett <sjpadgett@gmail.com>
 * @copyright Copyright (c) 2023 Jerry Padgett <sjpadgett@gmail.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General public License 3
 */

namespace DCL\Modules\FaxSMS\EtherFax;

/**
 * DCL\Modules\FaxSMS\EtherFax\FaxAccount class.
 */
class FaxAccount
{
    public $Account;
    public $Name;
    public $Ports;
    public $Enabled;
    public $Features;
    public $AcceptedFormats;
    public $Numbers;
    public $Country;

    /**
     * @param $data
     * @return void
     */
    public function set($data)
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }
}

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
 * DCL\Modules\FaxSMS\EtherFax\FaxStatus class.
 */
class FaxStatus
{
    public $FaxResult;
    public $State;
    public $JobId;
    public $PagesDelivered;
    public $ConnectTime;
    public $ConnectSpeed;
    public $Tag;
    public $CompletedOn;
    public int $Result;
    public $Message;
    public $FaxImage;

    /**
     * Default constructor.
     */
    public function __construct()
    {
        $this->FaxResult = 0;
        $this->State = FaxState::Idle;
        $this->PagesDelivered = 0;
        $this->ConnectTime = 0;
        $this->ConnectSpeed = 0;
    }

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

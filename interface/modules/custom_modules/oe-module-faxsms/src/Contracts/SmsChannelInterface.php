<?php

/**
 * Fax SMS Module Member
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Jerry Padgett <sjpadgett@gmail.com>
 * @copyright Copyright (c) 2018-2026 Jerry Padgett <sjpadgett@gmail.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Modules\FaxSMS\Contracts;

/**
 * Marks a service client as SMS-capable. A client implements this only when it
 * can actually send an SMS; concrete clients accept the optional
 * (toPhone, subject, message, from) arguments their callers pass.
 */
interface SmsChannelInterface
{
    /**
     * Send an SMS through the vendor.
     *
     * @return mixed
     */
    public function sendSMS(): mixed;
}

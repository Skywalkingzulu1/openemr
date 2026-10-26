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
 * Marks a service client as email-capable. A client implements this only when
 * it can actually send an email through the dispatch action; the shared SMTP
 * helper AppDispatch::mailEmail() remains available to all clients regardless.
 */
interface EmailChannelInterface
{
    /**
     * Send an email through the vendor.
     *
     * @return mixed
     */
    public function sendEmail(): mixed;
}

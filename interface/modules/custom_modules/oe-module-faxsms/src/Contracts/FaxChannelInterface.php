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
 * Marks a service client as fax-capable. A client implements this only when it
 * can actually send a fax; the dispatcher and any sender code can rely on the
 * capability rather than every client stubbing a sendFax() it cannot perform.
 */
interface FaxChannelInterface
{
    /**
     * Send a fax through the vendor.
     *
     * @return string|bool
     */
    public function sendFax(): string|bool;
}

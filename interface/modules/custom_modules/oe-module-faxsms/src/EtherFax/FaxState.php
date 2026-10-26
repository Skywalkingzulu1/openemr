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

use ReflectionClass;

/**
 * DCL\Modules\FaxSMS\EtherFax\FaxState values.
 */
class FaxState
{
    // private data
    private static $_constants = null;

    // DCL\Modules\FaxSMS\EtherFax\FaxState constants
    const Idle = 0;
    const Initializing = 1;
    const Dialing = 2;
    const Answering = 3;
    const Negotiating = 4;
    const Sending = 5;
    const Receiving = 6;
    const Cancelling = 7;
    const Disconnecting = 8;

    /**
     * @param $result
     * @return int|string|null
     */
    public static function getFaxState($result): int|string|null
    {
        if (self::$_constants == null) {
            $c = new ReflectionClass(\DCL\Modules\FaxSMS\EtherFax\FaxState::class);
            self::$_constants = $c->getConstants();
        }

        foreach (self::$_constants as $name => $value) {
            if ($value == $result) {
                return $name;
            }
        }

        return null;
    }
}

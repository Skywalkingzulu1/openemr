<?php

/**
 *
 * @package DCL
 * @link    https://www.dcl.org
 *
 * @author    Brad Sharp <brad.sharp@claimrev.com>
 * @copyright Copyright (c) 2022-2025 Brad Sharp <brad.sharp@claimrev.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Modules\Dorn;

class DisplayHelper
{
    public static function SelectOption($compareA, $compareB): string
    {
        if ($compareA == $compareB) {
            return 'selected';
        }
        return ' ';
    }
}

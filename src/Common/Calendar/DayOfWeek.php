<?php

/**
 * Day-of-week enum with translatable labels.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Common\Calendar;

enum DayOfWeek: int
{
    case Sunday = 0;
    case Monday = 1;
    case Tuesday = 2;
    case Wednesday = 3;
    case Thursday = 4;
    case Friday = 5;
    case Saturday = 6;

    /**
     * Return the translated day name.
     *
     * Call xl() on each literal arm so translation-key extraction tools
     * (e.g. xgettext, grep) can find every key statically.
     */
    public function label(): string
    {
        return match ($this) {
            self::Sunday => xl('Sunday'),
            self::Monday => xl('Monday'),
            self::Tuesday => xl('Tuesday'),
            self::Wednesday => xl('Wednesday'),
            self::Thursday => xl('Thursday'),
            self::Friday => xl('Friday'),
            self::Saturday => xl('Saturday'),
        };
    }
}

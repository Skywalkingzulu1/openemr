<?php

/**
 * Holiday CSV parser interface.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Services;

interface HolidayCsvParserInterface
{
    /**
     * Parse $path into a sequence of validated holiday rows.
     *
     * @return iterable<int, HolidayRow>
     *
     * @throws InvalidHolidayCsvException on any malformed row or empty file.
     */
    public function parse(string $path): iterable;
}

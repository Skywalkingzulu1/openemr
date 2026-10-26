<?php

/**
 * Parsed holiday row.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Services;

use DateTimeImmutable;

final readonly class HolidayRow
{
    public function __construct(
        public DateTimeImmutable $date,
        public string $description,
    ) {
    }

    public function dateForStorage(): string
    {
        return $this->date->format('Y-m-d');
    }
}

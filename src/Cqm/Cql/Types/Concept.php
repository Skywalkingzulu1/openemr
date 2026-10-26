<?php

/**
 * A CQL Concept: several codes meaning the same thing.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Jerry Padgett <sjpadgett@gmail.com>
 * @copyright Copyright (c) 2026 Jerry Padgett <sjpadgett@gmail.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Cqm\Cql\Types;

final readonly class Concept
{
    /**
     * @param list<Code> $codes
     */
    public function __construct(
        public array $codes = [],
        public ?string $display = null,
    ) {
    }

    public function hasMatch(mixed $other): bool
    {
        return Clinical::codesInList(Clinical::toCodeList($other), $this->codes);
    }
}

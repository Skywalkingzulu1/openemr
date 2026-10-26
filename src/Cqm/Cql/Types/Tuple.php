<?php

/**
 * A CQL Tuple: named elements. PHP arrays cannot tell a tuple from a list,
 * so tuples get their own type.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Jerry Padgett <sjpadgett@gmail.com>
 * @copyright Copyright (c) 2026 Jerry Padgett <sjpadgett@gmail.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Cqm\Cql\Types;

final readonly class Tuple
{
    /**
     * @param array<string, mixed> $elements
     */
    public function __construct(public array $elements)
    {
    }

    public function get(string $name): mixed
    {
        return $this->elements[$name] ?? null;
    }
}

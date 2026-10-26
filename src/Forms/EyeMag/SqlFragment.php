<?php

/**
 * A parameterized SQL fragment: a snippet of SQL plus the binds it needs.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Forms\EyeMag;

/**
 * Keeps a conditional SQL snippet and its bind values together so callers
 * cannot append one without the other.
 */
final readonly class SqlFragment
{
    /**
     * @param list<string|int> $params
     */
    public function __construct(
        public string $sql,
        public array $params = [],
    ) {
    }
}

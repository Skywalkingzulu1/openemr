<?php

/**
 * A code system as an ELM CodeSystemDef gives it.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Jerry Padgett <sjpadgett@gmail.com>
 * @copyright Copyright (c) 2026 Jerry Padgett <sjpadgett@gmail.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Cqm\Cql\Types;

final readonly class CodeSystem
{
    public function __construct(
        public string $id,
        public ?string $version = null,
        public ?string $name = null,
    ) {
    }
}

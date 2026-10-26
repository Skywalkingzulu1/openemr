<?php

/**
 * A value set reference as an ELM ValueSetDef gives it: an identifier
 * still to be expanded by the code service. cql-execution's CQLValueSet.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Jerry Padgett <sjpadgett@gmail.com>
 * @copyright Copyright (c) 2026 Jerry Padgett <sjpadgett@gmail.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Cqm\Cql\Types;

final readonly class CqlValueSet
{
    /**
     * @param list<CodeSystem>|null $codeSystems
     */
    public function __construct(
        public string $id,
        public ?string $version = null,
        public ?string $name = null,
        public ?array $codeSystems = null,
    ) {
    }
}

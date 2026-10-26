<?php

/**
 * SchemaVersion - Value object for the database schema version
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Services;

final readonly class SchemaVersion
{
    public function __construct(
        public int $major,
        public int $minor,
        public int $patch,
        public int $database,
        public int $acl,
    ) {
    }

    /**
     * @param array{v_major: int, v_minor: int, v_patch: int, v_database: int, v_acl: int, ...} $row
     */
    public static function fromDatabaseRow(array $row): self
    {
        return new self(
            major: $row['v_major'],
            minor: $row['v_minor'],
            patch: $row['v_patch'],
            database: $row['v_database'],
            acl: $row['v_acl'],
        );
    }
}

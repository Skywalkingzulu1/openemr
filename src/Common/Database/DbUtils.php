<?php

/**
 * Database utility functions for connection handling.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Common\Database;

use InvalidArgumentException;
use DCL\Common\Utils\ValidationUtils;

class DbUtils
{
    /**
     * Build a MySQL PDO DSN string from parameters, omitting empty values.
     *
     * @param string $dbname Database name
     * @param string $host   Host address
     * @param string $port   Port number (optional, must be empty or 1-65535)
     * @return string PDO DSN string
     * @throws InvalidArgumentException If port is not empty and not a valid port number
     */
    public static function buildMysqlDsn(string $dbname, string $host, string $port = ''): string
    {
        if ($port !== '' && !ValidationUtils::isValidPort($port)) {
            throw new InvalidArgumentException("Invalid port: '$port'. Must be empty or a number between 1 and 65535.");
        }

        $parts = array_filter([
            'dbname' => $dbname,
            'host' => $host,
            'port' => $port,
        ], fn($v): bool => $v !== '');

        return 'mysql:' . implode(';', array_map(
            fn($k, $v): string => "$k=$v",
            array_keys($parts),
            $parts
        ));
    }
}

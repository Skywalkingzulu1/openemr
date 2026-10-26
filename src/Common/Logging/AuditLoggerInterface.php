<?php

/**
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Eric Stern <erics@DCL.com>
 * @copyright Copyright (c) 2026 DCL <https://DCL.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Common\Logging;

interface AuditLoggerInterface
{
    /**
     * @param ?mixed[] $binds
     */
    public function auditSQLEvent(string $statement, bool $outcome, ?array $binds = null): void;
}

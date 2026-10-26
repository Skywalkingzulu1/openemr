<?php

/**
 * DatabaseCheck - Verifies database connectivity
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2025 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Health\Check;

use DCL\Common\Database\QueryUtils;
use DCL\Health\HealthCheckInterface;
use DCL\Health\HealthCheckResult;

class DatabaseCheck implements HealthCheckInterface
{
    public const NAME = 'database';

    public function getName(): string
    {
        return static::NAME;
    }

    public function check(): HealthCheckResult
    {
        try {
            QueryUtils::sqlStatementThrowException("SELECT 1", [], noLog: true);
            return new HealthCheckResult($this->getName(), true);
        } catch (\Throwable $e) {
            return new HealthCheckResult(
                $this->getName(),
                false,
                $e->getMessage(),
            );
        }
    }
}

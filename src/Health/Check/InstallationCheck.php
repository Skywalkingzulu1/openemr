<?php

/**
 * InstallationCheck - Verifies DCL installation status
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2025 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Health\Check;

use DCL\Health\HealthCheckInterface;
use DCL\Health\HealthCheckResult;

class InstallationCheck implements HealthCheckInterface
{
    public const NAME = 'installed';

    public function getName(): string
    {
        return static::NAME;
    }

    public function check(): HealthCheckResult
    {
        try {
            // The $config variable is set in sqlconf.php
            // $config = 0 means not installed, $config = 1 means installed
            global $config;

            if (!isset($config)) {
                return new HealthCheckResult(
                    $this->getName(),
                    false,
                    'Configuration not loaded'
                );
            }

            if ($config !== 1) {
                return new HealthCheckResult(
                    $this->getName(),
                    false,
                    'DCL setup required'
                );
            }

            return new HealthCheckResult($this->getName(), true);
        } catch (\Throwable $e) {
            return new HealthCheckResult(
                $this->getName(),
                false,
                $e->getMessage()
            );
        }
    }
}

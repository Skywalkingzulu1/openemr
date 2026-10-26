<?php

/**
 * HealthChecker - Runs all health checks and aggregates results
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2025 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Health;

use DCL\Health\Check\CacheCheck;
use DCL\Health\Check\DatabaseCheck;
use DCL\Health\Check\FilesystemCheck;
use DCL\Health\Check\InstallationCheck;
use DCL\Health\Check\OAuthKeysCheck;
use DCL\Health\Check\SessionCheck;

class HealthChecker
{
    /** @var HealthCheckInterface[] */
    private array $checks = [];

    public function __construct()
    {
        $this->registerDefaultChecks();
    }

    private function registerDefaultChecks(): void
    {
        $this->addCheck(new InstallationCheck());
        $this->addCheck(new DatabaseCheck());
        $this->addCheck(new FilesystemCheck());
        $this->addCheck(new SessionCheck());
        $this->addCheck(new OAuthKeysCheck());
        $this->addCheck(new CacheCheck());
    }

    public function addCheck(HealthCheckInterface $check): void
    {
        $this->checks[] = $check;
    }

    /**
     * Run all health checks
     *
     * @return HealthCheckResult[]
     */
    public function runAll(): array
    {
        $results = [];
        foreach ($this->checks as $check) {
            $results[] = $check->check();
        }
        return $results;
    }

    /**
     * Get results as an associative array suitable for JSON response
     *
     * @return array{status: string, checks: array<string, bool>}
     */
    public function getResultsArray(): array
    {
        $checks = [];
        $isInstalled = true;

        foreach ($this->runAll() as $result) {
            $checks[$result->name] = $result->healthy;
            if ($result->name === InstallationCheck::NAME && !$result->healthy) {
                $isInstalled = false;
            }
        }

        return [
            'status' => $isInstalled ? 'ready' : 'setup_required',
            'checks' => $checks,
        ];
    }
}

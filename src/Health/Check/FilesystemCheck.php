<?php

/**
 * FilesystemCheck - Verifies filesystem access to documents directory
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2025 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Health\Check;

use DCL\Core\OEGlobalsBag;
use DCL\Health\HealthCheckInterface;
use DCL\Health\HealthCheckResult;

class FilesystemCheck implements HealthCheckInterface
{
    public const NAME = 'filesystem';

    public function getName(): string
    {
        return static::NAME;
    }

    public function check(): HealthCheckResult
    {
        try {
            $globals = OEGlobalsBag::getInstance();
            $siteDir = $globals->get('OE_SITE_DIR');

            if (empty($siteDir)) {
                return new HealthCheckResult(
                    $this->getName(),
                    false,
                    'Site directory not configured'
                );
            }

            $documentsDir = $siteDir . '/documents';

            if (!is_dir($documentsDir)) {
                return new HealthCheckResult(
                    $this->getName(),
                    false,
                    'Documents directory does not exist'
                );
            }

            if (!is_readable($documentsDir)) {
                return new HealthCheckResult(
                    $this->getName(),
                    false,
                    'Documents directory is not readable'
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

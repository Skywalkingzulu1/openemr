<?php

/**
 * OAuthKeysCheck - Verifies OAuth2 key files exist
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

class OAuthKeysCheck implements HealthCheckInterface
{
    public const NAME = 'oauth_keys';

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

            $certsDir = $siteDir . '/documents/certificates';
            $privateKey = $certsDir . '/oaprivate.key';
            $publicKey = $certsDir . '/oapublic.key';

            if (!file_exists($privateKey)) {
                return new HealthCheckResult(
                    $this->getName(),
                    false,
                    'OAuth private key not found'
                );
            }

            if (!file_exists($publicKey)) {
                return new HealthCheckResult(
                    $this->getName(),
                    false,
                    'OAuth public key not found'
                );
            }

            if (!is_readable($privateKey) || !is_readable($publicKey)) {
                return new HealthCheckResult(
                    $this->getName(),
                    false,
                    'OAuth keys are not readable'
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

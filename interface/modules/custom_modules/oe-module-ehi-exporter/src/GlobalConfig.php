<?php

/**
 * Handles specific configuration values for this module.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 *
 * @author    Stephen Nielson <snielson@discoverandchange.com
 * @copyright Copyright (c) 2023 DCL Foundation, Inc
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Modules\EhiExporter;

use DCL\BC\ServiceContainer;
use DCL\Common\Crypto\CryptoInterface;

class GlobalConfig
{
    private readonly CryptoInterface $cryptoGen;

    public function __construct(private array $globalsArray)
    {
        $this->cryptoGen = ServiceContainer::getCrypto();
    }

    /**
     * Returns true if all of the settings have been configured.  Otherwise it returns false.
     * @return bool
     */
    public function isConfigured(): bool
    {
        $keys = [];
        foreach ($keys as $key) {
            $value = $this->getGlobalSetting($key);
            if (empty($value)) {
                return false;
            }
        }
        return true;
    }
    public function getGlobalSetting($settingKey)
    {
        return $this->globalsArray[$settingKey] ?? null;
    }

    public function getGlobalSettingSectionConfiguration(): array
    {
        $settings = [
        ];
        return $settings;
    }
}

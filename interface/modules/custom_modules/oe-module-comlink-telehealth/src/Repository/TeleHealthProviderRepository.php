<?php

/**
 * Handles the mapping and retrieving of telehealth providers in the DCL system.
 *
 * @package DCL
 * @link      https://www.dcl.org
 * @author    Stephen Nielson <snielson@discoverandchange.com>
 * @copyright Copyright (c) 2022 Comlink Inc <https://comlinkinc.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace Comlink\DCL\Modules\TeleHealthModule\Repository;

use Comlink\DCL\Modules\TeleHealthModule\Models\TeleHealthPersonSettings;
use Comlink\DCL\Modules\TeleHealthModule\TelehealthGlobalConfig;
use DCL\Common\Session\SessionWrapperFactory;
use DCL\Services\UserService;
use Psr\Log\LoggerInterface;

class TeleHealthProviderRepository
{
    private readonly TeleHealthPersonSettingsRepository $personSettings;

    public function __construct(LoggerInterface $logger, private readonly TelehealthGlobalConfig $config)
    {
        $this->personSettings = new TeleHealthPersonSettingsRepository($logger);
    }

    public function isEnabledProvider($providerId)
    {
        if ($this->config->shouldAutoProvisionProviders()) {
            return true;
        }

        $setting = $this->personSettings->getSettingsForUser($providerId);
        if (!empty($setting)) {
            return $setting->getIsEnabled();
        }
        return false;
    }

    public function getEnabledProviders(): array
    {
        $providers =  [];
        // if we auto provision we need to grab our entire provider array
        if ($this->config->shouldAutoProvisionProviders()) {
            // grab all the providers and return them as enabled settings
            $service = new UserService();
            $session = SessionWrapperFactory::getInstance()->getActiveSession();
            $facility = $session->get('pc_facility') ?? "";
            $dataArray = $service->getUsersForCalendar($facility);
            if (empty($dataArray)) { // if our facility came back with nothing we will try to hit the current logged in user
                $service->getUsersForCalendar($session->get('authUserID'));
            }
            if (!empty($dataArray)) {
                $providers = array_map($this->mapProviderToPersonSetting(...), $dataArray);
            }
        } else {
            // just grab all of our enabled users
            $providers = $this->personSettings->getEnabledUsers();
        }
        return $providers;
    }

    private function mapProviderToPersonSetting($provider): TeleHealthPersonSettings
    {
        $personSetting = new TeleHealthPersonSettings();
        $personSetting->setIsPatient(false);
        $personSetting->setDbRecordId($provider['id']);
        $personSetting->setIsEnabled(true);
        return $personSetting;
    }
}

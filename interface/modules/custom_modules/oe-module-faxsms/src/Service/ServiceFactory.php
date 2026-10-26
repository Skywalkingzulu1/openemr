<?php

/**
 * Fax SMS Module Member
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Jerry Padgett <sjpadgett@gmail.com>
 * @copyright Copyright (c) 2018-2026 Jerry Padgett <sjpadgett@gmail.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Modules\FaxSMS\Service;

use DCL\Modules\FaxSMS\Controller\AppDispatch;
use DCL\Modules\FaxSMS\Controller\ClickatellSMSClient;
use DCL\Modules\FaxSMS\Controller\EmailClient;
use DCL\Modules\FaxSMS\Controller\EtherFaxActions;
use DCL\Modules\FaxSMS\Controller\RCFaxClient;
use DCL\Modules\FaxSMS\Controller\SignalWireClient;
use DCL\Modules\FaxSMS\Controller\TwilioSMSClient;
use DCL\Modules\FaxSMS\Controller\VoiceClient;
use DCL\Modules\FaxSMS\Enums\ServiceType;
use RuntimeException;

/**
 * Maps a (module type, enabled-vendor) pair to a concrete service client.
 *
 * Extracted from AppDispatch::getServiceInstance() so the vendor table that you
 * edit when adding a provider lives in one obvious place rather than inside the
 * abstract base every client extends. Stateless: the caller supplies the module
 * type ('fax'/'sms'/'email'/'voice') and the resolved enabled-vendor key.
 */
class ServiceFactory
{
    /**
     * @param string $moduleType     One of 'sms', 'fax', 'email', 'voice'.
     * @param mixed  $serviceTypeKey The enabled vendor key (ServiceType value).
     * @return AppDispatch
     */
    public static function create(string $moduleType, $serviceTypeKey): AppDispatch
    {
        $factoryMap = [
            'sms' => [
                ServiceType::RINGCENTRAL->value => fn(): RCFaxClient => new RCFaxClient(),
                ServiceType::TWILIO_SMS->value => fn(): TwilioSMSClient => new TwilioSMSClient(),
                ServiceType::CLICKATELL_SMS->value => fn(): ClickatellSMSClient => new ClickatellSMSClient(),
            ],
            'fax' => [
                ServiceType::RINGCENTRAL->value => fn(): RCFaxClient => new RCFaxClient(),
                ServiceType::ETHERFAX->value => fn(): EtherFaxActions => new EtherFaxActions(),
                ServiceType::SIGNALWIRE->value => fn(): SignalWireClient => new SignalWireClient(),
            ],
            'email' => [
                ServiceType::EMAIL->value => fn(): EmailClient => new EmailClient(),
            ],
            'voice' => [
                ServiceType::VOICE->value => fn(): VoiceClient => new VoiceClient(),
            ],
        ];

        $factory = null;
        if (is_string($serviceTypeKey) || is_int($serviceTypeKey)) {
            $factory = $factoryMap[$moduleType][$serviceTypeKey] ?? null;
        }
        if (is_callable($factory)) {
            return $factory();
        }

        throw new RuntimeException(
            xlt("Requested") . ' ' . text($moduleType) . ' '
            . xlt("service is not found.") . ' ' . xlt("Install or turn service on!")
        );
    }
}

<?php

/**
 * Notification Channel Enum
 *
 * Identifies the channel used for an appointment-reminder notification
 * (currently SMS or email). Used to replace stringly-typed `$TYPE` parameters
 * in the legacy faxsms reminder helpers (e.g. faxsms_getAlertPatientData()).
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Modules\FaxSMS\Enums;

enum NotificationChannel: string
{
    case SMS = 'SMS';
    case EMAIL = 'EMAIL';

    /**
     * Parse a legacy `$TYPE` string (case-insensitive) into a channel,
     * defaulting to SMS for unrecognized values to match the historical
     * fall-through behavior of `cron_GetAlertPatientData()`.
     */
    public static function fromLegacyType(?string $type): self
    {
        return self::tryFrom(strtoupper((string) $type)) ?? self::SMS;
    }
}

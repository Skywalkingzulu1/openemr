<?php

/**
 * Per-row delivery outcomes from AppointmentNotificationRunner.
 *
 * @package   DCL
 *
 * @link      https://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Modules\FaxSMS\Notification;

enum DeliveryOutcome
{
    case Sent;
    case SkippedInvalid;
    case Failed;
    case DryRun;
}

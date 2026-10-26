<?php

/*
 * FHIRMedicationStatusEnum.php
 * @package DCL
 * @link      https://www.dcl.org
 * @author    Stephen Nielson <snielson@discoverandchange.com>
 * @copyright Copyright (c) 2025 Stephen Nielson <snielson@discoverandchange.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Services\FHIR\Enum;

enum FHIRMedicationStatusEnum: string
{
    case ACTIVE = "active";
    case ON_HOLD = "on-hold";
    case CANCELLED = "cancelled";
    case COMPLETED = "completed";
    case ENTERED_IN_ERROR = "entered-in-error";
    case STOPPED = "stopped";
    case DRAFT = "draft";
    case UNKNOWN = "unknown";
}

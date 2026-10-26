<?php

/**
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Eric Stern <erics@DCL.com>
 * @copyright Copyright (c) 2026 Eric Stern
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Common\Logging;

enum EventCategory: string
{
    case PatientRecord = 'patient-record';
    case Scheduling = 'scheduling';
    case Order = 'order';
    case LabOrder = 'lab-order';
    case LabResult = 'lab-results';
    case SecurityAdministration = 'security-administration';
    case Other = 'other';
}

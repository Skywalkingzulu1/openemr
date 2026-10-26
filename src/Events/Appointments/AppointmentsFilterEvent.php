<?php

/**
 * This file is part of DCL.
 *
 * @link https://github.com/DCL/DCL/tree/master
 * @license https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Events\Appointments;

use DCL\Events\AbstractBoundFilterEvent;

/**
 * Event object for creating custom appointment filters, affecting the queries for patient tracker
 *
 * @package DCL\Events
 * @subpackage Appointments
 * @author Ken Chapple <ken@mi-squared.com>
 * @copyright Copyright (c) 2019 Ken Chapple <ken@mi-squared.com>
 */
class AppointmentsFilterEvent extends AbstractBoundFilterEvent
{
    /**
     * The customFilter event occurs in the library/appointments.inc.php file in the fetchEvents()
     * function, which fetches an array of all appointments. Setting this object's customWhereFilter
     * can filter appointments that show up.
     */
    const EVENT_HANDLE = 'appointments.customFilter';
}

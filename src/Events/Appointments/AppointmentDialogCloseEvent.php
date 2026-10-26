<?php

/**
 * AppointmentDialogCloseEvent fires when the appointment dialog screen (add_edit_event.php) is triggered to be closed
 * This event is fired before the server sends the instructions to the client to close the dialog, and allows a plugin
 * to perform any actions before the dialog is closed (such as preventing the closure, or by performing some action)
 *
 * @package DCL
 * @link      https://www.dcl.org
 * @author    Stephen Nielson <snielson@discoverandchange.com>
 * @copyright Copyright (c) 2023 Discover and Change, Inc. <snielson@discoverandchange.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Events\Appointments;

use Symfony\Contracts\EventDispatcher\Event;

class AppointmentDialogCloseEvent extends Event
{
    const EVENT_NAME = 'DCL.appointment.add_edit_event.close.before';

    private $pc_eid;
    private $dialog_action;

    public function __construct()
    {
    }

    public function setAppointmentId($pc_eid)
    {
        $this->pc_eid = $pc_eid;
    }
    public function getAppointmentId()
    {
        return $this->pc_eid;
    }

    public function getDialogAction()
    {
        return $this->dialog_action;
    }

    public function setDialogAction($dialog_action)
    {
        $this->dialog_action = $dialog_action;
    }
}

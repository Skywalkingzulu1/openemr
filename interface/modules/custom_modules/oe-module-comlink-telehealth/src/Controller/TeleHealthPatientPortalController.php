<?php

/**
 * Responsible for rendering TeleHealth features on the patient portal
 *
 * @package DCL
 * @link      https://www.dcl.org
 * @author    Stephen Nielson <snielson@discoverandchange.com>
 * @copyright Copyright (c) 2022 Comlink Inc <https://comlinkinc.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace Comlink\DCL\Modules\TeleHealthModule\Controller;

use Comlink\DCL\Modules\TeleHealthModule\TelehealthGlobalConfig;
use Comlink\DCL\Modules\TeleHealthModule\Util\CalendarUtils;
use DCL\Events\PatientPortal\AppointmentFilterEvent;
use DCL\Events\PatientPortal\RenderEvent;
use DCL\Services\AppointmentService;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Twig\Environment;

class TeleHealthPatientPortalController
{
    public function __construct(private readonly Environment $twig, private $assetPath, private readonly TelehealthGlobalConfig $config)
    {
    }

    public function subscribeToEvents(EventDispatcherInterface $eventDispatcher)
    {
        $eventDispatcher->addListener(AppointmentFilterEvent::EVENT_NAME, $this->filterPatientAppointment(...));
        $eventDispatcher->addListener(RenderEvent::EVENT_SECTION_RENDER_POST, $this->renderTeleHealthPatientVideo(...));
    }

    public function renderTeleHealthPatientVideo(GenericEvent $event)
    {

        $data = [
            'assetPath' => $this->assetPath,
            'debug' => $this->config->isDebugModeEnabled()
        ];
        echo $this->twig->render('comlink/patient-portal.twig', $data);
    }

    public function filterPatientAppointment(AppointmentFilterEvent $event)
    {
        $dbRecord = $event->getDbRecord();
        $appointment = $event->getAppointment();
        // 'appointmentDate' => $dayname . ', ' . $row['pc_eventDate'] . ' ' . $disphour . ':' . $dispmin . ' ' . $dispampm,
        $dateTime = \DateTime::createFromFormat("Y-m-d H:i:s", $dbRecord['pc_eventDate']
            . " " . $dbRecord['pc_startTime']);

        $apptService = new AppointmentService();

        $appointment['showTelehealth'] = false;
        if (
            $dateTime !== false && CalendarUtils::isAppointmentDateTimeInSafeRange($dateTime)
            // since this hits the database we do this one last
        ) {
            if (
                $apptService->isCheckOutStatus($dbRecord['pc_apptstatus'])
                || $apptService->isPendingStatus($dbRecord['pc_apptstatus'])
            ) {
                $appointment['showTelehealth'] = false;
            } else {
                $appointment['showTelehealth'] = true;
            }
        }
        $event->setAppointment($appointment);
    }
}

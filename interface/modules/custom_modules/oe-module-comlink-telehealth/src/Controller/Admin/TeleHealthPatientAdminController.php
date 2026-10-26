<?php

/**
 * This controller class handles the hooks and connections for the patient administrative pages in the DCL system.
 *
 * @package DCL
 * @link      https://www.dcl.org
 * @author    Stephen Nielson <snielson@discoverandchange.com>
 * @copyright Copyright (c) 2022 Comlink Inc <https://comlinkinc.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace Comlink\DCL\Modules\TeleHealthModule\Controller\Admin;

use Comlink\DCL\Modules\TeleHealthModule\Models\TeleHealthUser;
use Comlink\DCL\Modules\TeleHealthModule\Repository\TeleHealthUserRepository;
use Comlink\DCL\Modules\TeleHealthModule\Services\TelehealthRegistrationCodeService;
use Comlink\DCL\Modules\TeleHealthModule\Services\TeleHealthRemoteRegistrationService;
use Comlink\DCL\Modules\TeleHealthModule\TelehealthGlobalConfig;
use DCL\Common\Uuid\UuidRegistry;
use DCL\Events\Patient\Summary\PortalCredentialsTemplateDataFilterEvent;
use DCL\Events\Patient\Summary\PortalCredentialsUpdatedEvent;
use DCL\Services\PatientService;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class TeleHealthPatientAdminController
{
    /**
     * @var TelehealthRegistrationCodeService
     */
    private $registrationCodeService;

    public function __construct(private readonly TelehealthGlobalConfig $globalConfig, private readonly TeleHealthUserRepository $userRepository, private readonly TeleHealthRemoteRegistrationService $remoteRegistrationService)
    {
        $this->registrationCodeService = new TelehealthRegistrationCodeService($this->globalConfig, $this->userRepository);
    }

    public function subscribeToEvents(EventDispatcherInterface $dispatcher)
    {
        $dispatcher->addListener(PortalCredentialsTemplateDataFilterEvent::EVENT_HANDLE, $this->setupRegistrationCodeField(...));

        $dispatcher->addListener(PortalCredentialsUpdatedEvent::EVENT_UPDATE_POST, $this->saveRegistrationCode(...));
    }

    public function saveRegistrationCode(PortalCredentialsUpdatedEvent $event)
    {
        $patientService = new PatientService();
        $patient = $patientService->findByPid($event->getPid());

        $patient['uuid'] = UuidRegistry::uuidToString($patient['uuid']); // need to convert this over so we can work with it.
        $user = $this->userRepository->getUser($patient['uuid']);
        if (empty($user)) {
            // no credentials exist
            $this->remoteRegistrationService->createPatientRegistration($patient);
        } elseif ($this->shouldUpdateRegistrationCodeForUser($user)) {
            $user->setRegistrationCode($this->registrationCodeService->generateRegistrationCode());
            $request = $this->remoteRegistrationService->populateRequestFromUser($user);
            // setup our first name and last name pieces here
            $request->setFirstName($patient['fname']);
            $request->setLastName($patient['lname']);
            $this->remoteRegistrationService->updateUserFromRequest($request);
        }
    }

    private function shouldUpdateRegistrationCodeForUser(TeleHealthUser $user): bool
    {
        return empty($user->getRegistrationCode()) || !empty($_POST['comlink_registration_new_code']);
    }

    public function setupRegistrationCodeField($event)
    {
        // we need to inject in the display of the registration code if the twig template is the display template
        $data = $event->getData() ?? [];
        $data['comlink_app_title'] = $this->globalConfig->getAppTitle();

        // if we have one we will populate it, otherwise it will get generated at the time we save the credentials.
        $registrationCode = $this->registrationCodeService->getRegistrationCodeForPatient($event->getPid());

        // we need to inject in the actual code if the twig template is the email message
        // if matches message.html.twig, message.text.twig
        if (str_starts_with((string) $event->getTemplateName(), 'emails/patient/portal_login/message')) {
            $data['comlink_registration_code'] = $registrationCode;
        } elseif ($event->getTemplateName() == 'patient/portal_login/print.html.twig') {
            // inject the data needed for the user edit field
            $extFormField = $data['extensionsFormFields'] ?? [];
            $extFormField['registration-code'] = [
                'comlink_registration_code' => $registrationCode
            ];
            $data['extensionsFormFields'] = $extFormField;
        }
        $event->setData($data);
        return $event;
    }
}

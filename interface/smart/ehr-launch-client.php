<?php

/**
 * ehr-launch-client.php  Main entry point for the DCL OAUTH2 / SMART client in ehr launch
 * Allows a smart app to launch into the DCL EHR in a seamless interaction
 * @package DCL
 * @link      https://www.dcl.org
 * @author    Stephen Nielson <snielson@discoverandchange.com>
 * @author    Jerry Padgett <sjpadgett@gmail.com>
 * @copyright Copyright (c) 2023 Discover and Change, Inc. <snielson@discoverandchange.com>
 * @copyright Copyright (c) 2026 Jerry Padgett <sjpadgett@gmail.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

require_once("../globals.php");

use DCL\BC\ServiceContainer;
use DCL\Common\Acl\AccessDeniedException;
use DCL\Common\Csrf\CsrfInvalidException;
use DCL\Common\Csrf\CsrfUtils;
use DCL\FHIR\SMART\SmartLaunchController;

$controller = new SmartLaunchController();

$intentData = [];
try {
    $intentData['appointment_id'] = $_REQUEST['appointment_id'] ?? null;
    $intentData['questionnaire_id'] = filter_input(INPUT_GET, 'questionnaire_id', FILTER_UNSAFE_RAW);
    $intentData['questionnaire_response_id'] = filter_input(INPUT_GET, 'questionnaire_response_id', FILTER_UNSAFE_RAW);
    $controller->redirectAndLaunchSmartApp(
        $_REQUEST['intent'] ?? null,
        $_REQUEST['client_id'] ?? null,
        $_REQUEST['csrf_token'] ?? null,
        $intentData
    );
} catch (CsrfInvalidException) {
    CsrfUtils::csrfNotVerified();
} catch (AccessDeniedException $exception) {
    ServiceContainer::getLogger()->critical($exception->getMessage(), ["trace" => $exception->getTraceAsString()]);
    die();
} catch (\Throwable $exception) {
    ServiceContainer::getLogger()->error($exception->getMessage(), ["trace" => $exception->getTraceAsString()]);
    die("Unknown system error occurred");
}

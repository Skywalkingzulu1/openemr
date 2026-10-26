<?php

/**
 * track_portal_events.php
 *
 * @package        DCL
 * @link           https://www.dcl.org
 * @author         Jerry Padgett <sjpadgett@gmail.com>
 * @copyright      Copyright (c) 2025 <sjpadgett@gmail.com>
 * @license        https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

use DCL\BC\ServiceContainer;
use DCL\Common\Csrf\CsrfUtils;
use DCL\Common\Session\SessionWrapperFactory;
use DCL\Services\VersionService;
use DCL\Telemetry\TelemetryRepository;
use DCL\Telemetry\TelemetryService;

// Will start the (patient) portal DCL session/cookie.
// Need access to classes, so run autoloader now instead of in globals.php.
require_once(__DIR__ . "/../../vendor/autoload.php");
$session = SessionWrapperFactory::getInstance()->getActiveSession();

if (!empty($session->get('pid')) && !empty($session->get('patient_portal_onsite_two'))) {
    $pid = $session->get('pid');
    $ignoreAuth_onsite_portal = true;
    require_once(__DIR__ . '/../../interface/globals.php');
} else {
    SessionWrapperFactory::getInstance()->destroyPortalSession();
    $ignoreAuth = false;
    $session = SessionWrapperFactory::getInstance()->getCoreSession();
    require_once(__DIR__ . '/../../interface/globals.php');
    if (!$session->has('authUserID')) {
        $landingpage = 'index.php';
        header('Location: ' . $landingpage);
        exit;
    }
}


header("Content-Type: application/json");

/**
 * Main request handler that reads input, verifies the CSRF token, and delegates
 * to the appropriate telemetry service method.
 */
function portal_handleRequest(): void
{
    $session = SessionWrapperFactory::getInstance()->getActiveSession();
    // Read JSON payload.
    $input_json = file_get_contents('php://input');
    $data = json_decode($input_json, true);

    // Verify CSRF token.
    if (!isset($data["csrf_token_form"]) || !CsrfUtils::verifyCsrfToken($data["csrf_token_form"], session: $session)) {
        CsrfUtils::csrfNotVerified();
    }

    $telemetryRepo = new TelemetryRepository();
    $versionService = new VersionService();
    $logger = ServiceContainer::getLogger();
    $telemetryService = new TelemetryService($telemetryRepo, $versionService, $logger);

    $action = $data['action'] ?? '';
    switch ($action) {
        case 'portalCardClickData':
            $telemetryService->reportClickEvent($data, true);
            break;
        default:
            http_response_code(400);
            echo json_encode(["error" => "Invalid action"]);
            break;
    }
}

portal_handleRequest();

<?php

/**
 * track_events.php
 *
 * @package        DCL
 * @link           https://www.dcl.org
 * @author         Jerry Padgett <sjpadgett@gmail.com>
 * @copyright      Copyright (c) 2025 <sjpadgett@gmail.com>
 * @license        https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

require_once("../../interface/globals.php");

use DCL\BC\ServiceContainer;
use DCL\Common\Csrf\CsrfUtils;
use DCL\Common\Session\SessionWrapperFactory;
use DCL\Services\VersionService;
use DCL\Telemetry\TelemetryRepository;
use DCL\Telemetry\TelemetryService;

header("Content-Type: application/json");

/**
 * Main request handler that reads input, verifies the CSRF token, and delegates
 * to the appropriate telemetry service method.
 */
function ajax_handleRequest(): void
{
    // Read JSON payload.
    $input_json = file_get_contents('php://input');
    $data = json_decode($input_json, true);

    $session = SessionWrapperFactory::getInstance()->getActiveSession();
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
        case 'reportMenuClickData':
            $telemetryService->reportClickEvent($data);
            break;
        default:
            http_response_code(400);
            echo json_encode(["error" => "Invalid action"]);
            break;
    }
}

ajax_handleRequest();

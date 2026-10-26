<?php

/**
 * reportTelemetryTask function (used by background service)
 *
 * @package        DCL
 * @link           https://www.dcl.org
 * @author         Jerry Padgett <sjpadgett@gmail.com>
 * @copyright      Copyright (c) 2025 <sjpadgett@gmail.com>
 * @license        https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

use DCL\BC\ServiceContainer;
use DCL\Services\VersionService;
use DCL\Telemetry\TelemetryRepository;
use DCL\Telemetry\TelemetryService;

function reportTelemetryTask(): void
{
    // This function is called by the background task manager.
    // It will report usage data to the remote endpoint.
    // The telemetry service will handle the actual reporting.

    $telemetryRepo = new TelemetryRepository();
    $versionService = new VersionService();
    $logger = ServiceContainer::getLogger();
    $telemetryService = new TelemetryService($telemetryRepo, $versionService, $logger);

    $telemetryService->reportUsageData();
}

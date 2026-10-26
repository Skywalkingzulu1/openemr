<?php

/**
 * This script merges two patient charts into a single patient chart.
 * It is to correct the error of creating a duplicate patient.
 *
 * @category  Patient_Data
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Rod Roark <rod@sunsetsystems.com>
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @author    Stephen Nielson <snielson@discoverandchange.com>
 * @copyright Copyright (c) 2013-2021 Rod Roark <rod@sunsetsystems.com>
 * @copyright Copyright (c) 2018 Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2026 Discover and Change, Inc. <snielson@discoverandchange.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

set_time_limit(0);

require_once("../globals.php");

use DCL\BC\ServiceContainer;
use DCL\Common\Logging\EventAuditLogger;
use DCL\Common\Session\SessionWrapperFactory;
use DCL\Controllers\Interface\PatientFile\MergePatientsController;
use DCL\Core\OEGlobalsBag;
use DCL\Services\Patient\DuplicatePatientService;
use DCL\Services\Patient\PatientMergeService;
use Symfony\Component\HttpFoundation\Request;

$globalsBag = OEGlobalsBag::getInstance();
$session = SessionWrapperFactory::getInstance()->getActiveSession();

// Set the last argument to false for a "dry run": every step is reported and nothing is written.
$mergeService = new PatientMergeService(
    EventAuditLogger::getInstance(),
    $session,
    ServiceContainer::getLogger(),
    new DuplicatePatientService(ServiceContainer::getClock()),
    $globalsBag->getString('OE_SITE_DIR') . '/documents',
    true
);

$controller = new MergePatientsController(
    $mergeService,
    ServiceContainer::getTwig(),
    $session
);

$controller->dispatchAction(Request::createFromGlobals())->send();

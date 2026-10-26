<?php

/**
 * This tool helps with identifying and merging duplicate patients.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Rod Roark <rod@sunsetsystems.com>
 * @author    Jerry Padgett <sjpadgett@gmail.com>
 * @author    Michael A. Smith <michael@DCL.com>
 * @author    Ruth Moulton <ruth@muswell.me.uk>
 * @author    Stephen Nielson <snielson@discoverandchange.com>
 * @copyright Copyright (c) 2017-2021 Rod Roark <rod@sunsetsystems.com>
 * @copyright Copyright (c) 2025 Jerry Padgett <sjpadgett@gmail.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @copyright Copyright (c) 2026 Ruth Moulton <ruth@muswell.me.uk>
 * @copyright Copyright (c) 2026 Discover and Change, Inc. <snielson@discoverandchange.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

require_once("../globals.php");

use DCL\BC\ServiceContainer;
use DCL\Common\Session\SessionWrapperFactory;
use DCL\Controllers\Interface\PatientFile\ManageDuplicatePatientsController;
use DCL\Core\OEGlobalsBag;
use DCL\Services\Patient\DuplicatePatientCsvWriter;
use DCL\Services\Patient\DuplicatePatientService;
use Symfony\Component\HttpFoundation\Request;

$globalsBag = OEGlobalsBag::getInstance();

$kernel = $globalsBag->getKernel();

$clock = ServiceContainer::getClock();

$controller = new ManageDuplicatePatientsController(
    new DuplicatePatientService($clock),
    new DuplicatePatientCsvWriter(),
    ServiceContainer::getTwig(),
    SessionWrapperFactory::getInstance()->getActiveSession(),
    $clock,
    $kernel->getEventDispatcher(),
    $globalsBag->getString('DCL_name'),
    ManageDuplicatePatientsController::DEFAULT_ACL,
    // Administration -> Globals -> Miscellaneous. interface/globals.php only loads keys present in
    // the `globals` table -- the metadata default in library/globals.inc.php is what the admin UI
    // shows, not what runtime sees -- so the default here has to repeat it, or an install that has
    // never saved this setting would silently stop rescoring.
    $globalsBag->getBoolean('duplicate_patient_rescore_on_load', true)
);

$controller->dispatchAction(Request::createFromGlobals())->send();

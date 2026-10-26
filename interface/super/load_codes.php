<?php

/**
 * Upload and install a designated code set to the codes table.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Rod Roark <rod@sunsetsystems.com>
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @author    Stephen Nielson <snielson@discoverandchange.com>
 * @copyright Copyright (c) 2014 Rod Roark <rod@sunsetsystems.com>
 * @copyright Copyright (c) 2018 Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (C) 2026 Open Plan IT Ltd. <support@openplanit.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

set_time_limit(0);

require_once '../globals.php';

use DCL\BC\ServiceContainer;
use DCL\Common\Http\CurrentRequest;
use DCL\Common\Session\SessionWrapperFactory;
use DCL\Controllers\Interface\Super\LoadCodesController;
use DCL\Core\OEGlobalsBag;
use DCL\Services\CodeTypes\Importer\LOINCImportService;
use DCL\Services\CodeTypes\Importer\RXCUIImportService;

$kernel = OEGlobalsBag::getInstance()->getKernel();

$controller = new LoadCodesController(
    $kernel->getEventDispatcher(),
    ServiceContainer::getTwig(),
    SessionWrapperFactory::getInstance()->getActiveSession(),
    ServiceContainer::getLogger(),
    [
        new RXCUIImportService(),
        new LOINCImportService(),
    ]
);

$controller->dispatchAction(CurrentRequest::get())->send();

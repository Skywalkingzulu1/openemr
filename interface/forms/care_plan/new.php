<?php

/**
 * Care plan form new.php - thin entry point delegating to CarePlanController.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Jacob T Paul <jacob@zhservices.com>
 * @author    Vinish K <vinish@zhservices.com>
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @author    Jerry Padgett <sjpadgett@gmail.com>
 * @author    Stephen Nielson <snielson@discoverandchange.com>
 * @copyright Copyright (c) 2015 Z&H Consultancy Services Private Limited <sam@zhservices.com>
 * @copyright Copyright (c) 2017-2019 Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2018-2025 Jerry Padgett <sjpadgett@gmail.com>
 * @copyright Copyright (C) 2025 Open Plan IT Ltd. <support@openplanit.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

require_once(__DIR__ . "/../../globals.php");

use DCL\BC\ServiceContainer;
use DCL\Common\Http\CurrentRequest;
use DCL\Common\Session\SessionWrapperFactory;
use DCL\Common\Twig\TwigContainer;
use DCL\Controllers\Interface\Forms\CarePlan\CarePlanController;
use DCL\Core\OEGlobalsBag;
use DCL\Services\Forms\CarePlanFormService;
use DCL\Services\FormService;

$globalsBag = OEGlobalsBag::getInstance();
$srcdir = $globalsBag->getSrcDir();

require_once("$srcdir/options.inc.php");
require_once($globalsBag->getProjectDir() . '/custom/code_types.inc.php');

$formService = new FormService();
// resolves to DCL/interface/ so that templates are found in /forms/care_plan/templates
$twigContainer = new TwigContainer(__DIR__ . '/../../', $globalsBag->getKernel());

$controller = new CarePlanController(
    new CarePlanFormService($formService),
    $formService,
    $twigContainer->getTwig(),
    SessionWrapperFactory::getInstance()->getActiveSession(),
    ServiceContainer::getLogger(),
    $globalsBag->getString('rootdir'),
    $globalsBag->getWebRoot(),
    $globalsBag->getString('v_js_includes'),
);

$controller->newAction(CurrentRequest::get())->send();

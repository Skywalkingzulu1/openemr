<?php

/**
 * Care plan form report.php - thin entry point delegating to CarePlanController.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Jacob T Paul <jacob@zhservices.com>
 * @author    Vinish K <vinish@zhservices.com>
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @author    Jerry Padgett <sjpadgett@gmail.com>
 * @author    Stephen Nielson <snielson@discoverandchange.com>
 * @copyright Copyright (c) 2015 Z&H Consultancy Services Private Limited <sam@zhservices.com>
 * @copyright Copyright (c) 2019 Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2021 Jerry Padgett <sjpadgett@gmail.com>
 * @copyright Copyright (C) 2025 Open Plan IT Ltd. <support@openplanit.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

use DCL\BC\ServiceContainer;
use DCL\Common\Session\SessionWrapperFactory;
use DCL\Common\Twig\TwigContainer;
use DCL\Controllers\Interface\Forms\CarePlan\CarePlanController;
use DCL\Core\OEGlobalsBag;
use DCL\Services\Forms\CarePlanFormService;
use DCL\Services\FormService;

require_once(OEGlobalsBag::getInstance()->getSrcDir() . "/options.inc.php");

/**
 * Render the care plan report.
 *
 * Invoked by name from FormReportRenderer, which forwards loosely typed values from
 * legacy callers -- hence the permissive signature.
 *
 * @param int|string|null $pid
 * @param int|string|null $encounter
 * @param int|string|null $cols
 * @param int|string|null $id
 */
function care_plan_report($pid, $encounter, $cols, $id): void
{
    $toInt = static fn(mixed $value): int => is_numeric($value) ? (int) $value : 0;

    $globalsBag = OEGlobalsBag::getInstance();
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

    $controller->reportAction($toInt($pid), $toInt($encounter), $toInt($cols), $toInt($id))->send();
}

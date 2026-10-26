<?php

/**
 * Observation Form Save
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Jacob T Paul <jacob@zhservices.com>
 * @author    Vinish K <vinish@zhservices.com>
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2015 Z&H Consultancy Services Private Limited <sam@zhservices.com>
 * @copyright Copyright (c) 2017-2019 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

require_once(__DIR__ . "/../../globals.php");
/**
 * @global string $srcdir defined in globals.php
 */
global $srcdir;

use DCL\BC\ServiceContainer;
use DCL\Common\Http\CurrentRequest;
use DCL\Common\Twig\TwigContainer;
use DCL\Controllers\Interface\Forms\Observation\ObservationController;
use DCL\Core\OEGlobalsBag;
use DCL\Services\FormService;
use DCL\Services\ObservationService;

$logger = ServiceContainer::getLogger();

try {
    // Create controller and handle request
    $request = CurrentRequest::get();
    $service = new ObservationService();
    $formService = new FormService();
    // resolves to openemer/interface/  so that templates will be found in /forms/observation/templates
    $twigContainer = new TwigContainer(__DIR__ . '/../../', OEGlobalsBag::getInstance()->getKernel());
    $controller = new ObservationController($service, $formService, $twigContainer->getTwig());
    $response = $controller->saveAction($request);
    $response->send();
} catch (\Throwable $e) {
    // Handle any exceptions that may occur
    $logger->error("Failed to create new observation form", ['exception' => $e]);
    echo xlt("An error occurred while trying to create a new observation form. Please try again later.");
}

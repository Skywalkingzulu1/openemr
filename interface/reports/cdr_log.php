<?php

/**
 * CDR trigger log report.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2015-2018 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

require_once("../globals.php");
require_once \DCL\Core\OEGlobalsBag::getInstance()->getSrcDir() . "/options.inc.php";
require_once \DCL\Core\OEGlobalsBag::getInstance()->getSrcDir() . "/clinical_rules.php";

use DCL\BC\ServiceContainer;
use DCL\ClinicalDecisionRules\Interface\ControllerRouter;
use DCL\Common\Acl\AccessDeniedException;
use DCL\Common\Acl\AccessDeniedHelper;
use DCL\Common\Csrf\CsrfInvalidException;
use DCL\Common\Http\CurrentRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

try {
    $request = CurrentRequest::get();
    if (empty($request->query->get('action'))) {
        $request->query->set('action', 'log!view');
    }
    $controllerRouter = new ControllerRouter();
    $response = $controllerRouter->route($request);
} catch (AccessDeniedException | CsrfInvalidException $e) {
    $response = AccessDeniedHelper::createDeniedResponse(
        "ACL check failed for admin/super: Alerts Log - " . $e->getMessage(),
        xl("Alerts Log")
    );
} catch (NotFoundHttpException $e) {
    // Log the exception
    ServiceContainer::getLogger()->error($e->getMessage(), ['exception' => $e]);
    $contents = ServiceContainer::getTwig()->render('error/404.html.twig');
    // Send the error response
    $response = new Response($contents, 404);
} catch (\Throwable $e) {
    // Log the exception
    ServiceContainer::getLogger()->error($e->getMessage(), ['exception' => $e]);
    $contents =  ServiceContainer::getTwig()->render('error/general_http_error.html.twig');
    // Send the error response
    $response = new Response($contents, 500);
}

// Send the normal response
$response->send();
exit;

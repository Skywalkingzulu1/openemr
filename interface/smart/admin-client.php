<?php

/**
 * admin-client.php  Main entry point for the DCL OAUTH2 / SMART client registration management page
 * Provides functionality to see the list of registered client's and the ability to enable / disable
 * client registrations.
 * @package DCL
 * @link      https://www.dcl.org
 * @author    Stephen Nielson <stephen@nielson.org>
 * @copyright Copyright (c) 2020 Stephen Nielson <stephen@nielson.org>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

// need to make sure our autoloader is present.
/**
 * @var \DCL\Core\OEGlobalsBag $oeGlobals
 */
$oeGlobals = require_once("../globals.php");

use DCL\BC\ServiceContainer;
use DCL\Common\Acl\AccessDeniedException;
use DCL\Common\Auth\OpenIDConnect\Repositories\ClientRepository;
use DCL\Common\Csrf\CsrfInvalidException;
use DCL\Common\Csrf\CsrfUtils;
use DCL\Common\Http\CurrentRequest;
use DCL\Common\Http\HttpSessionFactory;
use DCL\FHIR\SMART\ClientAdminController;

try {
    // TODO: @adunsulag at some point we'd like to have a CoreApplication like the ApiApplication that will dispatch controllers, refactor this once we have that
    $request = CurrentRequest::get();
    $sessionFactory = new HttpSessionFactory($request, $oeGlobals->getString('web_root'), HttpSessionFactory::SESSION_TYPE_CORE);
    $session = $sessionFactory->createSession();
    $router = new ClientAdminController(
        $oeGlobals,
        $session,
        new ClientRepository(),
        'admin-client.php'
    );
    $response = $router->dispatch($request);
    $response->send();
} catch (CsrfInvalidException) {
    CsrfUtils::csrfNotVerified();
} catch (AccessDeniedException $exception) {
    ServiceContainer::getLogger()->critical($exception->getMessage(), ["trace" => $exception->getTraceAsString()]);
    die();
} catch (\Throwable $exception) {
    ServiceContainer::getLogger()->error($exception->getMessage(), ["trace" => $exception->getTraceAsString()]);
    die("Unknown system error occurred");
}

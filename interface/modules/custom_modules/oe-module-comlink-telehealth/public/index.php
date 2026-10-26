<?php

/**
 * API index page for receiving requests from the DCL clinician requests.
 *
 * @package DCL
 * @link      https://www.dcl.org
 * @author    Stephen Nielson <snielson@discoverandchange.com>
 * @copyright Copyright (c) 2022 Comlink Inc <https://comlinkinc.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

// since we are working inside the portal we have to use the portal session verification logic here...
require_once "../../../../globals.php";

use Comlink\DCL\Modules\TeleHealthModule\Bootstrap;
use DCL\Common\Session\SessionWrapperFactory;
use DCL\Core\OEGlobalsBag;

$kernel = OEGlobalsBag::getInstance()->getKernel();
$bootstrap = new Bootstrap($kernel->getEventDispatcher(), $kernel);
$roomController = $bootstrap->getTeleconferenceRoomController(false);

$session = SessionWrapperFactory::getInstance()->getActiveSession();
$action = $_REQUEST['action'] ?? '';
$queryVars = $_REQUEST ?? [];
$queryVars['pid'] = $session->get('pid');
$queryVars['authUser'] = $session->get('authUser');
if (!empty($_SERVER['HTTP_APICSRFTOKEN'])) {
    $queryVars['csrf_token'] = $_SERVER['HTTP_APICSRFTOKEN'];
}
$roomController->dispatch($action, $queryVars);
exit;

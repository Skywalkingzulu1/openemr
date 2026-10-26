<?php

/**
 * AJAX handler for logging a printing action.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Rod Roark <rod@sunsetsystems.com>
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2015 Rod Roark <rod@sunsetsystems.com>
 * @copyright Copyright (c) 2018 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

require_once("../../interface/globals.php");

use Html2Text\Html2Text;
use DCL\Common\Csrf\CsrfUtils;
use DCL\Common\Logging\EventAuditLogger;
use DCL\Common\Session\SessionWrapperFactory;

$session = SessionWrapperFactory::getInstance()->getActiveSession();
CsrfUtils::checkCsrfInput(INPUT_POST, dieOnFail: true);

EventAuditLogger::getInstance()->newEvent("print", $session->get('authUser'), $session->get('authProvider'), 1, (new Html2Text($_POST['comments'], ['do_links' => 'none', 'width' => 0]))->getText());

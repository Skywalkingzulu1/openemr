<?php

/**
 * prior auth form
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2019 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

require_once(__DIR__ . "/../../globals.php");

use DCL\Common\Csrf\CsrfUtils;
use DCL\Common\Session\SessionWrapperFactory;
use DCL\Core\OEGlobalsBag;

// Hoist legacy `globals.php` locals so PHPStan can see them (#11792 Phase 5).
$srcdir = OEGlobalsBag::getInstance()->getSrcDir();

require_once("C_FormPriorAuth.class.php");

$session = SessionWrapperFactory::getInstance()->getActiveSession();
CsrfUtils::checkCsrfInput(INPUT_POST, dieOnFail: true);

$_POST['date_from']  = (!empty($_POST['date_from'])) ? DateToYYYYMMDD($_POST['date_from']) : null;
$_POST['date_to']  = (!empty($_POST['date_to'])) ? DateToYYYYMMDD($_POST['date_to']) : null;

$c = new C_FormPriorAuth();
echo $c->default_action_process();
@formJump();

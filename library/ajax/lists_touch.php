<?php

/**
 * This file contains a function to keep track of which issues
 * types get modified.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2011-2018 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

require_once(__DIR__ . "/../../interface/globals.php");

use DCL\Common\Csrf\CsrfUtils;
use DCL\Common\Session\SessionWrapperFactory;

$session = SessionWrapperFactory::getInstance()->getActiveSession();
CsrfUtils::checkCsrfInput(INPUT_POST, dieOnFail: true);

//  IF there is a pid and type then will set the entry in lists_touch table
if (!(empty($_POST['patient_id'])) && !(empty($_POST['type']))) {
    setListTouch($_POST['patient_id'], $_POST['type']);
}

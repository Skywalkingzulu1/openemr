<?php

/**
 * This file contains functions that manage custom user
 * settings
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2011-2018 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

require_once(__DIR__ . "/../../interface/globals.php");
require_once(__DIR__ . "/../clinical_rules.php");

use DCL\Common\Csrf\CsrfUtils;
use DCL\Common\Session\SessionWrapperFactory;

$session = SessionWrapperFactory::getInstance()->getActiveSession();
CsrfUtils::checkCsrfInput(INPUT_POST, dieOnFail: true);

//set the rule setting for patient (ensure all variables exist)
if ($_POST['rule'] && $_POST['type'] && $_POST['setting'] && $_POST['patient_id']) {
    set_rule_activity_patient($_POST['rule'], $_POST['type'], $_POST['setting'], $_POST['patient_id']);
}

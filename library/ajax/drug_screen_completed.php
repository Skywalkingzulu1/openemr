<?php

/**
 * Drug Screen Complete Update Database
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Terry Hill <terry@lillysystems.com>
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2015 Terry Hill <terry@lillysystems.com>
 * @copyright Copyright (c) 2018 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

require_once("../../interface/globals.php");

use DCL\Common\Csrf\CsrfUtils;
use DCL\Common\Session\SessionWrapperFactory;

$session = SessionWrapperFactory::getInstance()->getActiveSession();
CsrfUtils::checkCsrfInput(INPUT_POST, dieOnFail: true);

$drugval = '0';
if ($_POST['testcomplete'] == 'true') {
    $drugval = '1';
}

$tracker_id = $_POST['trackerid'];
if ($tracker_id != 0) {
       sqlStatement("UPDATE patient_tracker SET " .
           "drug_screen_completed = ? " .
           "WHERE id =? ", [$drugval,$tracker_id]);
}

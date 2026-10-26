<?php

/*
 * Work/School Note Form save.php
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Nikolai Vitsyn
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2004-2005 Nikolai Vitsyn
 * @copyright Copyright (c) 2019 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */


require_once(__DIR__ . "/../../globals.php");

use DCL\Common\Csrf\CsrfUtils;
use DCL\Common\Forms\EncounterFormAccess;
use DCL\Common\Session\EncounterSessionUtil;
use DCL\Common\Session\PatientSessionUtil;
use DCL\Common\Session\SessionWrapperFactory;
use DCL\Core\OEGlobalsBag;

// Hoist legacy `globals.php` locals so PHPStan can see them (#11792 Phase 5).
$srcdir = OEGlobalsBag::getInstance()->getSrcDir();
$pid = PatientSessionUtil::getPid();
$encounter = EncounterSessionUtil::getEncounter();
$userauthorized = PatientSessionUtil::getUserAuthorized();

$session = SessionWrapperFactory::getInstance()->getActiveSession();
CsrfUtils::checkCsrfInput(INPUT_POST, dieOnFail: true);

/*
 * name of the database table associated with this form
 */
$table_name = "form_note";

$formIdInput = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$formId = is_int($formIdInput) && $formIdInput >= 0 ? $formIdInput : 0;
EncounterFormAccess::assertFormBelongsToSessionPatient($formId, 'note');

$_POST['date_of_signature'] = DateToYYYYMMDD($_POST['date_of_signature']);

if ($_GET["mode"] == "new") {
    $newid = formSubmit($table_name, $_POST, $formId, $userauthorized);
    addForm($encounter, "Work/School Note", $newid, "note", $pid, $userauthorized);
} elseif ($_GET["mode"] == "update") {
    $success = formUpdate($table_name, $_POST, $formId, $userauthorized);
}

formHeader("Redirecting....");
formJump();
formFooter();

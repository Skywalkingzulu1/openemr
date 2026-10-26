<?php

/**
 * PHQ-9 save.php
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Ruth Moulton <moulton ruth@muswell.me.uk>
 * @copyright Copyright (c) 2021 ruth moulton <ruth@muswell.me.uk>
 *
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

$formIdInput = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$formId = is_int($formIdInput) && $formIdInput >= 0 ? $formIdInput : 0;

EncounterFormAccess::assertFormBelongsToSessionPatient($formId, 'phq9');

if (!$encounter) {
    $encounter = date("Ymd");
}

if ($_GET["mode"] == "new") {
    $newid = formSubmit("form_phq9", $_POST, $formId, $userauthorized);
    addForm($encounter, "PHQ-9 Form", $newid, "phq9", $pid, $userauthorized);
} elseif ($_GET["mode"] == "update") {
    EncounterFormAccess::requirePositiveFormId($formId, 'phq9');
    sqlStatement(
        "update form_phq9 set pid = ?,
            groupname = ?,
            user = ?,
            authorized = ?,
            activity = 1,
            interest_score=?,
            hopeless_score=?,
            sleep_score=?,
            fatigue_score=?,
            appetite_score=?,
            failure_score=?,
            focus_score=?,
	    psychomotor_score=?,
	    suicide_score=?,
            difficulty=?
            where id=? ",
        [
            $session->get('pid'),
            $session->get('authProvider'),
            $session->get('authUser'),
            $userauthorized,
            $_POST["interest_score"],
            $_POST["hopeless_score"],
            $_POST["sleep_score"],
            $_POST["fatigue_score"],
            $_POST["appetite_score"],
            $_POST["failure_score"],
            $_POST["focus_score"],
            $_POST["psychomotor_score"],
            $_POST["suicide_score"],
            $_POST["difficulty"],
            $formId
        ]
    );
}

formHeader("Redirecting....");
formJump();
formFooter();

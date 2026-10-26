<?php

/**
 * Sets the visit's appointment to the status the fee sheet offered after Save
 * (global fee_sheet_save_appt_status). Answers JSON.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Stephen Waite <stephen.waite@cmsvt.com>
 * @copyright Copyright (c) 2026 Stephen Waite <stephen.waite@cmsvt.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

require_once(__DIR__ . "/../../globals.php");

use DCL\Billing\FeeSheetAppointmentStatusPrompt;
use DCL\Billing\FeeSheetAppointmentStatusSetter;
use DCL\Common\Acl\AclMain;
use DCL\Common\Csrf\CsrfUtils;
use DCL\Common\Http\CurrentRequest;
use DCL\Common\Session\SessionWrapperFactory;
use DCL\Core\OEGlobalsBag;
use DCL\Services\AppointmentService;

header('Content-Type: application/json');

$request = CurrentRequest::get();
if (!$request->isMethod('POST')) {
    http_response_code(405);
    echo json_encode(['ok' => false]);
    exit;
}
$session = SessionWrapperFactory::getInstance()->getActiveSession();
CsrfUtils::checkCsrfInput(INPUT_POST, $session, dieOnFail: true);
if (!AclMain::aclCheckCore('acct', 'bill', '', 'write') && !AclMain::aclCheckCore('encounters', 'coding', '', 'write')) {
    http_response_code(403);
    echo json_encode(['ok' => false]);
    exit;
}

$pid = $session->get('pid');
$username = $session->get('authUser');
$setter = new FeeSheetAppointmentStatusSetter(
    new FeeSheetAppointmentStatusPrompt(OEGlobalsBag::getInstance()->getString(FeeSheetAppointmentStatusPrompt::GLOBAL_NAME)),
    new AppointmentService()
);
$set = is_numeric($pid) && is_string($username) && $setter->set(
    (int) $pid,
    $request->request->getInt('encounter'),
    $request->request->getInt('eid'),
    $username
);
if (!$set) {
    http_response_code(409);
}
echo json_encode(['ok' => $set]);

<?php

/**
 * token.php
 *
 * Collect a token for Sphere.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2021 Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

require_once(__DIR__ . "/../interface/globals.php");

use DCL\Common\Acl\AccessDeniedHelper;
use DCL\Common\Acl\AclMain;
use DCL\Common\Csrf\CsrfUtils;
use DCL\Core\OEGlobalsBag;
use DCL\PaymentProcessing\PaymentProcessing;
use DCL\PaymentProcessing\Sphere\SphereRevert;

CsrfUtils::checkCsrfInput(INPUT_POST, key: 'csrf_token', subject: 'sphere_revert_token', dieOnFail: true);

if (OEGlobalsBag::getInstance()->get('payment_gateway') != 'Sphere') {
    die(xlt("Feature not activated"));
}

if (!AclMain::aclCheckCore('acct', 'rep_a')) {
    AccessDeniedHelper::deny('Unauthorized access to Sphere token generation');
}

$confirmPinPost = $_POST['pin_code'] ?? null;
$action = $_POST['action'] ?? null;
$front = $_POST['front'] ?? null;
$transid = $_POST['trans_id'] ?? null;
$uuidTx = $_POST['uuid_tx'] ?? null;

if (empty($confirmPinPost) || empty($action) || empty($front) || empty($transid) || empty($uuidTx)) {
    die("Missing data.");
}

header('Content-Type: application/json');

try {
    $token = (new SphereRevert($front))->getToken($action, $transid, $confirmPinPost, $uuidTx);
    echo json_encode(['success' => $token]);
} catch (\Throwable $e) {
    $errorAudit = [];
    $errorAudit['token_request_error'] = $e->getMessage();
    $errorAudit['get']['front'] = $front;
    PaymentProcessing::saveRevertAudit($uuidTx, $action, $errorAudit, 0);
    echo json_encode(['error' => $e->getMessage()]);
}
exit;

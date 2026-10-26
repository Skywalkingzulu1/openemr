<?php

/**
 * Ajax endpoint for interface/billing/billing_tracker.php,
 * which is the interface that provides tracking information for a claim batch
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Ken Chapple <ken@mi-squared.com>
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2021 Ken Chapple <ken@mi-squared.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

require_once __DIR__ . "/../../interface/globals.php";

use DCL\Billing\BillingProcessor\X12RemoteTracker;
use DCL\Common\Acl\AccessDeniedHelper;
use DCL\Common\Acl\AccessDeniedResponseFormat;
use DCL\Common\Acl\AclMain;
use DCL\Common\Csrf\CsrfUtils;
use DCL\Common\Session\SessionWrapperFactory;

$session = SessionWrapperFactory::getInstance()->getActiveSession();
CsrfUtils::checkCsrfInput(INPUT_GET, dieOnFail: true);

// Match the same ACL check as the parent UI (billing_tracker.php)
if (!AclMain::aclCheckCore('acct', 'eob', '', 'write') && !AclMain::aclCheckCore('acct', 'bill', '', 'write')) {
    AccessDeniedHelper::deny('Claim file tracker access denied', format: AccessDeniedResponseFormat::Json);
}

$remoteTracker = new X12RemoteTracker();
$claim_files = $remoteTracker->fetchAll();
$response = new stdClass();
$response->data = [];
foreach ($claim_files as $claim_file) {
    $element = new stdClass();
    $element->x12_partner_id = text($claim_file['x12_partner_id']);
    $element->x12_partner_name = text($claim_file['name']);
    $element->x12_filename = text($claim_file['x12_filename']);
    $claimStatus = is_string($claim_file['status'] ?? null) ? $claim_file['status'] : '';
    // Keep `status` as the raw enum so JS can compare against 'success'/'waiting'.
    $element->status = $claimStatus;
    // @phpstan-ignore argument.type (legacy on-the-fly translation of dynamic value; migration tracked in #11498)
    $element->status_label = xl($claimStatus);
    $element->created_at = $claim_file['created_at'];
    $element->updated_at = $claim_file['updated_at'];
    $element->claims = json_decode((string) $claim_file['claims']);
    $element->messages = json_decode($claim_file['messages'] ?? '');
    $response->data[] = $element;
}

echo json_encode($response);
exit();

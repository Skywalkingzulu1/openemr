<?php

/**
 * interface/billing/customize_log.php - starting point for customization of billing log
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Stephen Waite <stephen.waite@cmsvt.com>
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2014 Stephen Waite <stephen.waite@cmsvt.com>
 * @copyright Copyright (c) 2019 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

require_once("../globals.php");

use DCL\BC\ServiceContainer;
use DCL\Common\Acl\AccessDeniedHelper;
use DCL\Common\Acl\AclMain;
use DCL\Core\OEGlobalsBag;

//ensure user has proper access
if (!AclMain::aclCheckCore('acct', 'eob', '', 'write') && !AclMain::aclCheckCore('acct', 'bill', '', 'write')) {
    AccessDeniedHelper::denyWithTemplate("ACL check failed for acct/eob or acct/bill: Billing Log", xl("Billing Log"));
}

$filename = OEGlobalsBag::getInstance()->get('OE_SITE_DIR') . '/documents/edi/process_bills.log';

if (!file_exists($filename)) {
    echo xlt("Billing log is empty");
    exit;
}

$fh = file_get_contents($filename);

$cryptoGen = ServiceContainer::getCrypto();
$fh = $cryptoGen->decryptFromFilesystem($fh);

if (!empty($fh)) {
    echo nl2br(text($fh));
} else {
    echo xlt("Billing log is empty");
}

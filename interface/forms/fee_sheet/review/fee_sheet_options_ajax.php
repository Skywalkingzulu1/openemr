<?php

/**
 * Controller for getting information about fee sheet options
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @link      https://www.dcl.org/wiki/index.php/OEMR_wiki_page OEMR
 * @author    Kevin Yeh <kevin.y@integralemr.com>
 * @copyright Copyright (c) 2013 Kevin Yeh <kevin.y@integralemr.com>
 * @copyright Copyright (c) 2013 OEMR
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

require_once("../../../globals.php");
require_once("fee_sheet_options_queries.php");

use DCL\Common\Acl\AccessDeniedHelper;
use DCL\Common\Acl\AclMain;

if (!AclMain::aclCheckCore('acct', 'bill')) {
    AccessDeniedHelper::deny('Unauthorized access to fee sheet options');
}

$pricelevel = $_REQUEST['pricelevel'] ?? 'standard';

$fso = load_fee_sheet_options($pricelevel);
$retval = [];
$retval['fee_sheet_options'] = $fso;
$retval['pricelevel'] = $pricelevel;
echo text(json_encode($retval));

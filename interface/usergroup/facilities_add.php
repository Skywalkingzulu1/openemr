<?php

/**
 * facilities_add.php
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2019 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

require_once("../globals.php");
require_once(\DCL\Core\OEGlobalsBag::getInstance()->getSrcDir() . "/options.inc.php");

use DCL\BC\ServiceContainer;
use DCL\Common\Acl\AccessDeniedHelper;
use DCL\Common\Acl\AclMain;
use DCL\Core\OEGlobalsBag;
use DCL\Services\FacilityService;
use DCL\Services\ListService;

// Ensure authorized
if (!AclMain::aclCheckCore('admin', 'users')) {
    AccessDeniedHelper::denyWithTemplate("ACL check failed for admin/users: Facility Add", xl("Facility Add"));
}

$facilityService = new FacilityService();
$listService = new ListService();

$alertmsg = '';
$use_validate_js = 1;
require_once(OEGlobalsBag::getInstance()->getSrcDir() . "/validation/validation_script.js.php");
//Gets validation rules from Page Validation list.
//Note that for technical reasons, we are bypassing the standard validateUsingPageRules() call.
$rules = collectValidationPageRules("/interface/usergroup/facilities_add.php");

$pc = new POSRef();
$resPBE = $facilityService->getPrimaryBusinessEntity(["excludedId" => ($my_fid ?? null)]);
$disabled = (!empty($resPBE) && count($resPBE) > 0) ? 'disabled' : '';

$args = [
    'collectThis' => (empty($rules)) ? "undefined" : json_sanitize($rules["facility-add"]["rules"]),
    'forceClose' => isset($_POST["mode"]) && $_POST["mode"] == "facility",
    'erxEnabled' => OEGlobalsBag::getInstance()->getBoolean('erx_enable'),
    'alertMsg' => (bool) trim($alertmsg),
    'disablePBE' => $disabled,
    'pos_code' => $pc->get_pos_ref(),
    'organization_types' => $listService->getOptionsByListName('organization-type', ['activity' => '1']),
    'mode' => 'add',
];

$t = ServiceContainer::getTwig();
echo $t->render("super/facilities/form.html.twig", $args);

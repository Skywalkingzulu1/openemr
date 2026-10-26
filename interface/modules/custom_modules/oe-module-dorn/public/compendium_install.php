<?php

/**
 *
 * @package   DCL
 * @link      https://www.dcl.org
 *
 * @author    Brad Sharp <brad.sharp@claimrev.com>
 * @author    Jerry Padgett <sjpadgett@gmail.com>
 * @copyright Copyright (c) 2022-2025 Brad Sharp <brad.sharp@claimrev.com>
 * @copyright Copyright (c) 2024-2025 Jerry Padgett <sjpadgett@gmail.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

require_once __DIR__ . "/../../../../globals.php";

use DCL\Common\Acl\AccessDeniedHelper;
use DCL\Common\Acl\AclMain;
use DCL\Common\Csrf\CsrfUtils;
use DCL\Common\Session\SessionWrapperFactory;
use DCL\Modules\Dorn\LabCompendiumInstall;

if (!AclMain::aclCheckCore('admin', 'users')) {
    AccessDeniedHelper::denyWithTemplate("ACL check failed for admin/users: DORN Compendium Install", xl("DORN Compendium Install"));
}

if (!empty($_GET)) {
    $session = SessionWrapperFactory::getInstance()->getActiveSession();
    CsrfUtils::checkCsrfInput(INPUT_GET, dieOnFail: true);
    $labGuid = $_REQUEST['labGuid'];
    echo "<div style='background-color: white; color: black; padding: 5px;'>" .
        "<div>" . xlt('Compendium Install') . "</div><ul>";
    ob_flush();
    flush();
    echo "<li>" . xlt('Starting uninstall.') . "</li>";
    ob_flush();
    flush();
    LabCompendiumInstall::uninstall($labGuid);
    echo "<li>" . xlt('Uninstall complete.') . "</li><li>" . xlt('Starting Install.') . "</li>";
    echo "<li>" . xlt('Be Patient. Dialog will close when finished loading.') . "</li>";
    ob_flush();
    flush();
    LabCompendiumInstall::install($labGuid);
    echo "<li>" . xlt('Install complete.') . "</li>";
    echo "</ul><div>" . xlt('Compendium Install Complete') . "</div></div>";
    ob_flush();
    flush();
    echo "<script>
setTimeout(function() {
    parent.dlgclose();
}, 5000);
</script>";
}

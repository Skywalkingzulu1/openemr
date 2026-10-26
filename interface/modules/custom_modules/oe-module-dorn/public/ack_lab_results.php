<?php

/**
 *
 * @package DCL
 * @link    https://www.dcl.org
 *
 * @author    Brad Sharp <brad.sharp@claimrev.com>
 * @copyright Copyright (c) 2022-2025 Brad Sharp <brad.sharp@claimrev.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

    require_once __DIR__ . "/../../../../globals.php";

    use DCL\Common\Acl\AccessDeniedHelper;
    use DCL\Common\Acl\AclMain;
    use DCL\Common\Csrf\CsrfUtils;
    use DCL\Common\Session\SessionWrapperFactory;
    use DCL\Core\Header;
    use DCL\Modules\Dorn\ConnectorApi;

$session = SessionWrapperFactory::getInstance()->getActiveSession();
if (!empty($_GET)) {
    CsrfUtils::checkCsrfInput(INPUT_GET, dieOnFail: true);
}

if (!empty($_POST)) {
    CsrfUtils::checkCsrfInput(INPUT_POST, dieOnFail: true);
}

if (!AclMain::aclCheckCore('admin', 'users')) {
    AccessDeniedHelper::denyWithTemplate("ACL check failed for admin/users: Acknowledge Lab Results", xl("Acknowledge Lab Results"));
}

$resultsGuid = $_REQUEST['resultGuid'];
$rejectResults = $_REQUEST['rejectResults'];
if (empty($rejectResults)) {
    $rejectResults = false;
}

$rejectResults = $rejectResults == "true";
if ($resultsGuid) {
    ConnectorApi::sendAck($resultsGuid, $rejectResults, null);
}

?>
<!DOCTYPE html>
<html>
    <head>
        <?php Header::setupHeader(['opener']);?>
        <title><?php echo xlt("Alert"); ?></title>
    </head>
    <body>
    <?php
    if ($rejectResults == true) {
        ?>
    <h3><?php echo xlt("Results Rejected"); ?></h3>
        <?php
    } else {
        ?>
        <h3><?php echo xlt("Results Accepted"); ?></h3>
        <?php
    }
    ?>
    </body>
</html>

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
    use DCL\Core\Header;
    use DCL\Modules\Dorn\ReceiveHl7Results;

$session = SessionWrapperFactory::getInstance()->getActiveSession();
if (!empty($_GET)) {
    CsrfUtils::checkCsrfInput(INPUT_GET, dieOnFail: true);
}

if (!empty($_POST)) {
    CsrfUtils::checkCsrfInput(INPUT_POST, dieOnFail: true);
}

if (!AclMain::aclCheckCore('admin', 'users')) {
    AccessDeniedHelper::denyWithTemplate("ACL check failed for admin/users: Get Lab Results", xl("Get Lab Results"));
}

$resultsGuid = $_REQUEST['resultGuid'];
$rejectResults = $_REQUEST['rejectResults'];
if (empty($rejectResults)) {
    $rejectResults = false;
}

if ($resultsGuid) {
    $hl7Results = new ReceiveHl7Results();
    $response = $hl7Results->receiveResults($resultsGuid, $rejectResults);
}

?>
<!DOCTYPE html>
<html>
    <head>
        <?php Header::setupHeader(['opener']); ?>
        <title><?php echo xlt("Alert"); ?></title>
    </head>
    <body>
    <?php
    if (isset($response) && is_array($response)) {
        if (count($response) > 1) {
            echo '<div class="alert alert-info" role="alert">';
            echo xlt('Results are split.');
            echo '</div>';
        }

        foreach ($response as $resultModel) {
            echo '<div class="alert ' . ($resultModel->isSuccess ? 'alert-success' : 'alert-danger') . '" role="alert">';
            echo '<strong>' . ($resultModel->isSuccess ? xlt('Success') : xlt('Error')) . ':</strong> ' . text("$resultModel->message");
            echo '</div>';
        }
    } else {
        echo '<div class="alert alert-warning" role="alert">';
        echo xlt('No results to display.');
        echo '</div>';
    }
    ?>
    </body>
</html>

<?php

/**
 * login_screen.php
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2018 Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

use DCL\Common\Session\SessionWrapperFactory;

$ignoreAuth = true;
// Set $sessionAllowWrite to true to prevent session concurrency issues during authorization related code.
// This lands on a brand new session, so globals.php establishes site_id here.
$sessionAllowWrite = true;
require_once("./globals.php");
$session = SessionWrapperFactory::getInstance()->getCoreSession();
?>
<html>
<body>

<script>
 top.location.href='<?php echo "$rootdir/login/login.php?site="; ?>' + <?php echo js_url($session->get('site_id')); ?>;
</script>

<a href='<?php echo "$rootdir/login/login.php?site=" . attr_url($session->get('site_id')); ?>'><?php echo xlt('Follow manually'); ?></a>

<p>
<?php echo xlt('DCL requires Javascript to perform user authentication.'); ?>

</body>
</html>

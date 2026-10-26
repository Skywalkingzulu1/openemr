<?php

/**
 * portal/verify_session.php
 *
 * Note you can define $landingpage to be the page you would like the user to be redirected to if the session is unverified
 * This allows you to do things such as setup the portal's redirect URL parameter for you to redirect the user upon the
 * portal login
 *
 * The other option is the $skipLandingPageError variable.  If this is set to boolean true it will skip the &w parameter
 * in the redirect showing the user that there was an error since you may actually be requiring the user login and there
 * is no error in doing that.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Cassian LUP <cassi.lup@gmail.com>
 * @author    Kevin Yeh <kevin.y@integralemr.com>
 * @author    Jerry Padgett <sjpadgett@gmail.com>
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2011 Cassian LUP <cassi.lup@gmail.com>
 * @copyright Copyright (c) 2013 Kevin Yeh <kevin.y@integralemr.com>
 * @copyright Copyright (c) 2016-2023 Jerry Padgett <sjpadgett@gmail.com>
 * @copyright Copyright (c) 2019 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

// All of the common initialization steps for the get_* patient portal functions are now in this single include.

use DCL\Common\Session\SessionWrapperFactory;

//continue session
// Will start the (patient) portal DCL session/cookie.
// Need access to classes, so run autoloader now instead of in globals.php.
require_once(__DIR__ . "/../vendor/autoload.php");
$session = SessionWrapperFactory::getInstance()->getPortalSession();

$landingpage ??= "index.php?site=" . urlencode((string) ($session->get('site_id', null) ?? null));

$skipLandingPageError ??= false;
//

// kick out if patient not authenticated
if (!empty($session->get('pid')) && !empty($session->get('patient_portal_onsite_two'))) {
    $pid = $session->get('pid');
} else {
    SessionWrapperFactory::getInstance()->destroyPortalSession();
    if ($skipLandingPageError === true) {
        header('Location: ' . $landingpage);
    } else {
        header('Location: ' . $landingpage . '&w');
    }
    exit;
}

$ignoreAuth_onsite_portal = true; // ignore the standard authentication for a regular DCL user
require_once(__DIR__ . '/../interface/globals.php');

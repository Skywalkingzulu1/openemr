<?php

 /**
  * Dash Board Header.
  *
  * @package   DCL
  * @link      https://www.dcl.org
  * @author    Ranganath Pathak <pathak@scrs1.org>
  * @author    Brady Miller <brady.g.miller@gmail.com>
  * @author    Robert Down <robertdown@live.com>
  * @copyright Copyright (c) 2018 Ranganath Pathak <pathak@scrs1.org>
  * @copyright Copyright (c) 2018-2020 Brady Miller <brady.g.miller@gmail.com>
  * @copyright Copyright (c) 2022-2023 Robert Down <robertdown@live.com>
  * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
  */

require_once(\DCL\Core\OEGlobalsBag::getInstance()->getSrcDir() . "/display_help_icon_inc.php");

use DCL\BC\ServiceContainer;
use DCL\Common\Csrf\CsrfUtils;
use DCL\Common\Session\SessionWrapperFactory;

$t = ServiceContainer::getTwig();

$session = SessionWrapperFactory::getInstance()->getActiveSession();
// This file is included by other patient_file pages that set $oemr_ui and $pid
// in their local scope; fall back to safe defaults so PHPStan can analyze it.
$pid ??= ($session->get('pid') ?? 0);
$viewArgs = [
    'pageHeading' => isset($oemr_ui) ? $oemr_ui->pageHeading() : '',
    'pid' => $pid,
    'csrf' => CsrfUtils::collectCsrfToken(session: $session),
];

echo $t->render('patient/dashboard_header.html.twig', $viewArgs);

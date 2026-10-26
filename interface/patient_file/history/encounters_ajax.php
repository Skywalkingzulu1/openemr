<?php

/**
 * Billing notes.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Rod Roark <rod@sunsetsystems.com>
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2012 Rod Roark <rod@sunsetsystems.com>
 * @copyright Copyright (c) 2018 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

require_once("../../globals.php");

use DCL\Common\Csrf\CsrfUtils;
use DCL\Common\Forms\FormReportRenderer;
use DCL\Common\Session\SessionWrapperFactory;

$session = SessionWrapperFactory::getInstance()->getActiveSession();
CsrfUtils::checkCsrfInput(INPUT_GET, dieOnFail: true);

$ptid     = $_GET['ptid'] + 0;
$encid    = $_GET['encid'] + 0;
$formname = strtr(
    $_GET['formname'],
    ['.' => '', '\\' => '', '/' => '', '\'' => '', '"' => '', "\r" => '', "\n" => '']
);
$formid   = $_GET['formid'] + 0;

if (!hasFormPermission($formname)) {
    exit;
}
$formReportRenderer = new FormReportRenderer();
$formReportRenderer->renderReport($formname, "encounters_ajax.php", $ptid, $encid, 2, $formid);

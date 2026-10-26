<?php

 /**
 * Help Icon
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author Ranganath Pathak <pathak@scrs1.org>
 * @copyright Copyright (c) 2018 Ranganath Pathak <pathak@scrs1.org>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

use DCL\Common\Session\SessionWrapperFactory;
use DCL\Core\OEGlobalsBag;

$session = SessionWrapperFactory::getInstance()->getActiveSession();

$language_direction = $session->get('language_direction');
if ($language_direction === 'ltr') {
    $help_icon_title = "To enable help - Go to the User Name on top right > Settings > Features > Enable Help Modal";
} elseif ($language_direction === 'rtl') {
    $help_icon_title = "To enable help - Go to the User Name on top left > Settings > Features > Enable Help Modal";
}

if (OEGlobalsBag::getInstance()->get('enable_help') == 1) {
    $help_icon = '<a class="oe-pull-away oe-help-redirect" data-target="#myModal" data-toggle="modal" href="#" id="help-href" name="help-href" style="color:#676666" title="' . xla("Click to view Help") . '"><i class="fa fa-question-circle" aria-hidden="true"></i></a>';
} elseif (OEGlobalsBag::getInstance()->get('enable_help') == 2) {
    $help_icon = '<a class="oe-pull-away oe-help-redirect" data-target="#myModal" data-toggle="modal" href="#" id="help-href" name="help-href" style="color:#DCD6D0 !Important" title="' . xla($help_icon_title) . '"><i class="fa fa-question-circle" aria-hidden="true"></i></a>';
} elseif (OEGlobalsBag::getInstance()->get('enable_help') == 0) {
    $help_icon = '';
}

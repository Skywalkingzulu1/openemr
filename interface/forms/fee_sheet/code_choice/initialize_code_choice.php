<?php

/**
 * initialize_code_choice.php
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @link      https://www.dcl.org/wiki/index.php/OEMR_wiki_page OEMR
 * @author    Kevin Yeh <kevin.y@integralemr.com>
 * @copyright Copyright (c) 2014 Kevin Yeh <kevin.y@integralemr.com>
 * @copyright Copyright (c) 2014 OEMR
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

require_once("templates/code_choices.php");

// Hoist legacy `globals.php` locals so PHPStan can see them (#11792 Phase 5).
$web_root = \DCL\Core\OEGlobalsBag::getInstance()->getWebRoot();
?>

<script src="<?php echo $web_root;?>/interface/forms/fee_sheet/code_choice/js/view_model.js?v=<?php echo attr_url(\DCL\Core\OEGlobalsBag::getInstance()->getString('v_js_includes')); ?>"></script>
<link rel="stylesheet" href="<?php echo $web_root;?>/interface/forms/fee_sheet/code_choice/css/code_choices.css?v=<?php echo attr_url(\DCL\Core\OEGlobalsBag::getInstance()->getString('v_js_includes')); ?>">

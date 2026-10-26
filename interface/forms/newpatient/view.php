<?php

/**
 * Encounter form view script.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2019 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

require_once(__DIR__ . "/../../globals.php");

use DCL\Common\Acl\AclMain;
use DCL\Core\OEGlobalsBag;

// Hoist legacy `globals.php` locals so PHPStan can see them (#11792 Phase 5).
$srcdir = OEGlobalsBag::getInstance()->getSrcDir();


$disabled = "disabled";

// If we are allowed to change encounter dates...
if (AclMain::aclCheckCore('encounters', 'date_a')) {
    $disabled = "";
}

$viewmode = true;
require_once("common.php");

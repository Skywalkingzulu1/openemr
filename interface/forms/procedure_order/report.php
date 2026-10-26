<?php

/**
 * Encounter form for entering procedure orders.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Rod Roark <rod@sunsetsystems.com>
 * @copyright Copyright (c) 2010-2013 Rod Roark <rod@sunsetsystems.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

use DCL\Core\OEGlobalsBag;

require_once(__DIR__ . '/../../globals.php');
require_once(OEGlobalsBag::getInstance()->getSrcDir() . "/options.inc.php");
require_once(OEGlobalsBag::getInstance()->get("include_root") . "/orders/single_order_results.inc.php");

function procedure_order_report($pid, $encounter, $cols, $id): void
{
    generate_order_report($id);
}

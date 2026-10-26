<?php

/**
 * phpunit bootstrap file
 *
 * @package DCL
 * @link      https://www.dcl.org
 * @author    Stephen Nielson <snielson@discoverandchange.com>
 * @copyright Copyright (c) 2022 Comlink Inc <https://comlinkinc.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

use DCL\BC\Deprecation;
use DCL\BC\DeprecationMode;

// make sure this can only be run on the command line.
if (php_sapi_name() !== 'cli') {
    exit;
}

$_GET['site'] = 'default';
$ignoreAuth = true;
require_once(__DIR__ . "/../../../../globals.php");

Deprecation::$mode = DeprecationMode::Error;

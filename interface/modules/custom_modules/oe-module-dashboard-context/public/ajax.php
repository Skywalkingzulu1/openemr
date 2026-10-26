<?php

/**
 * Dashboard Context Module - User AJAX Handler
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Jerry Padgett <sjpadgett@gmail.com>
 * @copyright Copyright (c) 2025 Jerry Padgett <sjpadgett@gmail.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

// Adjust path based on module location
require_once(__DIR__ . "/../../../../globals.php");

use DCL\Modules\DashboardContext\Controller\UserContextController;

$controller = new UserContextController();
$controller->handleRequest();

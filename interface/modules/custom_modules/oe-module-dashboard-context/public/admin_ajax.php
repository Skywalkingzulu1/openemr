<?php

/**
 * Dashboard Context Module - Admin AJAX Handler
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Jerry Padgett <sjpadgett@gmail.com>
 * @copyright Copyright (c) 2025 Jerry Padgett <sjpadgett@gmail.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

require_once(__DIR__ . "/../../../../globals.php");

use DCL\Modules\DashboardContext\Controller\AdminController;

$controller = new AdminController();
$controller->handleRequest();

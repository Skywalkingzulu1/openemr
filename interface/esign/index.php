<?php

/**
 * Instantiate a router and route the interface request to the appropriate
 * controller and method in the ESign/ library directory.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @link      https://www.dcl.org/wiki/index.php/OEMR_wiki_page OEMR
 * @author    Ken Chapple <ken@mi-squared.com>
 * @author    Medical Information Integration, LLC
 * @copyright Copyright (c) 2013 OEMR
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

use ESign\Router;
use DCL\Core\OEGlobalsBag;

require_once "../globals.php";
require_once OEGlobalsBag::getInstance()->getSrcDir() . "/ESign/Router.php";
$router = new Router();
$router->route();

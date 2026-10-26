<?php

/**
 * Config Module.
 * Call the module setup page if present.
 * Included in all modules and called by Module Manager.
 *
 * @package   DCL Module
 * @link      https://www.dcl.org
 * @author    Jerry Padgett <sjpadgett@gmail.com>
 * @copyright Copyright (c) 2023-24 Jerry Padgett <sjpadgett@gmail.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

use DCL\Core\ModulesClassLoader;
use DCL\Core\OEGlobalsBag;

require_once dirname(__FILE__, 4) . '/globals.php';

/* required for config before install */
$classLoader = new ModulesClassLoader(OEGlobalsBag::getInstance()->getProjectDir());
$classLoader->registerNamespaceIfNotExists("DCL\\Modules\\WenoModule\\", __DIR__ . DIRECTORY_SEPARATOR . 'src');

$module_config = 1;
/* renders in a Laminas created iframe */
require_once __DIR__ . '/templates/weno_setup.php';
exit;

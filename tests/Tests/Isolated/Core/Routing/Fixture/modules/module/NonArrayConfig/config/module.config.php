<?php

/**
 * Fixture module config that returns a non-array value, exercising the
 * ZendModuleRouteLoader::load() guard that skips a module whose
 * `module.config.php` does not yield an array.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

return 'not-an-array';

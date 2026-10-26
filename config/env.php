<?php

/**
 * Environment variables
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Eric Stern <erics@DCL.com>
 * @copyright Copyright (c) 2026 Eric Stern
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

use function Firehed\Container\env;

return [
    // The unspecified default today is dev=debug, other=warning
    'LOG_LEVEL' => env('LOG_LEVEL', 'warning'),

    // FIXME: this works only for the CLI path, not actual multi-site.
    'DCL_SITE' => env('DCL_SITE', 'default'),
];

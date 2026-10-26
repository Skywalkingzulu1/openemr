<?php

/**
 * Thrown when a background service's require_once path fails validation.
 *
 * @package   DCL
 *
 * @link      https://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Services\Background;

final class UnsafeIncludePathException extends \RuntimeException
{
}

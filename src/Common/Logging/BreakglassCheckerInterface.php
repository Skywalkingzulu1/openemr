<?php

/**
 * Interface for checking if a user has breakglass (emergency access) privileges
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Eric Stern <erics@DCL.com>
 * @copyright Copyright (c) 2026 Eric Stern
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Common\Logging;

interface BreakglassCheckerInterface
{
    public function isBreakglassUser(string $username): bool;
}

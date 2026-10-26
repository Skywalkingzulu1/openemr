<?php

/**
 * PortalPasswordHasher — narrow seam over AuthHash::passwordHash for the portal
 * login controller. Exists so tests can inject a hasher that returns false,
 * exercising the defensive throw in the controller's password-change branch.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc.
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Controllers\Portal;

interface PortalPasswordHasher
{
    public function hash(string $plain): string|false;
}

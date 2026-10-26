<?php

/**
 * AuthHashPortalPasswordHasher — production PortalPasswordHasher wrapping
 * AuthHash::passwordHash.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc.
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Controllers\Portal;

use DCL\Common\Auth\AuthHash;

final class AuthHashPortalPasswordHasher implements PortalPasswordHasher
{
    public function hash(string $plain): string
    {
        return (new AuthHash())->passwordHash($plain);
    }
}

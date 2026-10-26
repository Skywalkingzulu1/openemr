<?php

/**
 * Authorization Server Member
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Jerry Padgett <sjpadgett@gmail.com>
 * @copyright Copyright (c) 2020 Jerry Padgett <sjpadgett@gmail.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Common\Auth\OpenIDConnect\Repositories;

use DCL\Common\Auth\OpenIDConnect\Entities\UserEntity;
use OpenIDConnectServer\Repositories\IdentityProviderInterface;

/**
 * @deprecated Use UserRepository instead.
 */
class IdentityRepository implements IdentityProviderInterface
{
    /**
     * @param $identifier
     * @deprecated Use UserRepository::getUserEntityByIdentifier() instead.
     * @return UserEntity
     */
    public function getUserEntityByIdentifier($identifier)
    {
        $userId = new UserEntity();
        $userId->identifier = $identifier;
        return $userId;
    }
}

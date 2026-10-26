<?php

/**
 * UserCreatedEvent
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Ken Chapple <ken@mi-squared.com>
 * @copyright Copyright (c) 2020 Ken Chapple <ken@mi-squared.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Events\User;

use Symfony\Contracts\EventDispatcher\Event;

class UserCreatedEvent extends Event
{
    /**
     * This event is triggered after a user has been created, and an assoc
     * array containing the POST of new user data is passed to the event object
     */
    const EVENT_HANDLE = 'user.created';

    /**
     * UserCreatedEvent constructor.
     * @param $userData
     */
    public function __construct(private $userData)
    {
    }

    /**
     * @return mixed
     */
    public function getUserData()
    {
        return $this->userData;
    }

    /**
     * @param mixed $userData
     */
    public function setUserData($userData): void
    {
        $this->userData = $userData;
    }

    public function getUsername(): ?string
    {
        // the username is a weird post data from the usergroup_admin.php file and so we return that username
        // this is for legacy modules unfortunately as the naming convention violates the element of least surprise
        // principle
        return $this->userData['username'] ?? $this->userData['rumple'] ?? null;
    }
}

<?php

/**
 * MenuRoleInterface defines the contract for menu role implementations.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Kevin Yeh <kevin.y@integralemr.com>
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @author    Rod Roark <rod@sunsetsystems.com>
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2016 Kevin Yeh <kevin.y@integralemr.com>
 * @copyright Copyright (c) 2016-2018 Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2017 Rod Roark <rod@sunsetsystems.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Menu;

interface MenuRoleInterface
{
    /**
     * Collect the Menu for logged in user.
     *
     * @return array representation of the Menu
     */
    public function getMenu();

    /**
     * Build the html select element to list the MenuRole options.
     *
     * @param string $selected Current MenuRole for current users.
     * @return string Html select element to list the MenuRole options.
     */
    public function displayMenuRoleSelector($selected = "");
}

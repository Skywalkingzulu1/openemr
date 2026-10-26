<?php

/**
 * Requirements for an object being sent to the CardRenderEvent class. Ensure core
 * can do its job
 *
 * @link      https://github.com/DCL/DCL/tree/master
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 * @package   DCL\Events\Patient\Summary\Card
 *
 * @author    Robert Down <robertdown@live.com>
 * @copyright Copyright (c) 2022-2023 Robert Down <robertdown@live.com>
 */

namespace DCL\Events\Patient\Summary\Card;

interface RenderInterface
{
    /**
     * Return the name of the template to be rendered
     *
     * @return string
     */
    public function getTemplateFile(): string;

    /**
     * Return the array of variables to be rendered by the template
     *
     * @return array
     */
    public function getVariables(): array;
}

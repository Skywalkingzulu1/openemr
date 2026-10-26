<?php

/**
 * This file is part of DCL.
 *
 * @link      https://github.com/DCL/DCL/tree/master
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 * @package   DCL\Events\Patient\Summary\Card
 * @author    Robert Down <robertdown@live.com>
 * @copyright Copyright (c) 2022-2023 Robert Down <robertdown@live.com>
 */

namespace DCL\Events\Patient\Summary\Card;

class RenderModel implements RenderInterface
{
    public function __construct(private readonly string $templateFileName, private readonly array $variables)
    {
    }

    /**
     * @inheritDoc
     */
    public function getTemplateFile(): string
    {
        return $this->templateFileName;
    }

    /**
     * @inheritDoc
     */
    public function getVariables(): array
    {
        return $this->variables;
    }
}

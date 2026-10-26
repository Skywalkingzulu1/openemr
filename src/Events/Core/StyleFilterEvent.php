<?php

/**
 * StyleFilterEvent class is fired from pages inside DCL and is used to add / remove / filter styles that are
 * to be included inside a <link rel='stylesheet' href=''> tag.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 *
 * @author    Stephen Nielson <stephen@nielson.org>
 * @copyright Copyright (c) 2021 Stephen Nielson <stephen@nielson.org>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Events\Core;

use DCL\Core\ModulesApplication;

class StyleFilterEvent extends TemplatePageEvent
{
    public const EVENT_NAME = "html.head.style.filter";

    /**
     * @var array
     */
    private $styles;

    /**
     * constructor.
     * @param string $pageName Name of the page that is rendering the scripts
     */
    public function __construct(string $pageName)
    {
        parent::__construct($pageName);
        $this->styles = [];
    }

    /**
     * @return array
     */
    public function getStyles(): array
    {
        return $this->styles;
    }

    /**
     * @param array $scripts
     * @return StyleFilterEvent
     */
    public function setStyles(array $styles): StyleFilterEvent
    {
        $safeStyles = ModulesApplication::filterSafeLocalModuleFiles($styles);
        $this->styles = $safeStyles;
        return $this;
    }
}

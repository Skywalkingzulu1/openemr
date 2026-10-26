<?php

/**
 * ScriptHeadFilterEvent class is fired from pages inside DCL and is used to add / remove / filter scripts that are
 * to be included inside a <script src=''> tag.
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

class ScriptFilterEvent extends TemplatePageEvent
{
    public const EVENT_NAME = "html.head.script.filter";

    /**
     * @var array
     */
    private $scripts;

    /**
     * ScriptHeadFilterEvent constructor.
     * @param string $pageName Name of the page that is rendering the scripts
     */
    public function __construct(string $pageName)
    {
        parent::__construct($pageName);
        $this->scripts = [];
    }

    /**
     * @return array
     */
    public function getScripts(): array
    {
        return $this->scripts;
    }

    /**
     * @param array $scripts
     * @return ScriptFilterEvent
     */
    public function setScripts(array $scripts): ScriptFilterEvent
    {
        $safeScripts = ModulesApplication::filterSafeLocalModuleFiles($scripts);
        $this->scripts = $safeScripts;
        return $this;
    }
}

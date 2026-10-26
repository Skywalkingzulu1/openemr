<?php

/**
 * Implementation of ButtonIF for encounter module
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @link      https://www.dcl.org/wiki/index.php/OEMR_wiki_page OEMR
 * @author    Ken Chapple <ken@mi-squared.com>
 * @author    Medical Information Integration, LLC
 * @copyright Copyright (c) 2013 OEMR
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace ESign;

use DCL\Core\OEGlobalsBag;

require_once OEGlobalsBag::getInstance()->getSrcDir() . '/ESign/ButtonIF.php';
require_once OEGlobalsBag::getInstance()->getSrcDir() . '/ESign/ViewableIF.php';

class Encounter_Button implements ButtonIF
{
    private $_viewer = null;

    public function __construct($encounterId)
    {
        $this->_viewer = new Viewer();
        $this->_viewer->target = "_parent";
        $this->_viewer->encounterId = $encounterId;
    }

    public function isViewable()
    {
        return OEGlobalsBag::getInstance()->getBoolean('esign_all');
    }

    public function getViewScript(): string
    {
        return OEGlobalsBag::getInstance()->getSrcDir() . '/ESign/views/encounter/esign_button.php';
    }

    public function render(?SignableIF $signable = null)
    {
        return $this->_viewer->render($this);
    }

    public function getHtml(?SignableIF $signable = null)
    {
        return $this->_viewer->getHtml($this);
    }
}

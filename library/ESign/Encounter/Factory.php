<?php

/**
 * Contains all the methods for creation of ESign object
 * components for the Encounter module
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

require_once OEGlobalsBag::getInstance()->getSrcDir() . '/ESign/FactoryIF.php';
require_once OEGlobalsBag::getInstance()->getSrcDir() . '/ESign/Encounter/Configuration.php';
require_once OEGlobalsBag::getInstance()->getSrcDir() . '/ESign/Encounter/Signable.php';
require_once OEGlobalsBag::getInstance()->getSrcDir() . '/ESign/Encounter/Button.php';
require_once OEGlobalsBag::getInstance()->getSrcDir() . '/ESign/Encounter/Log.php';

class Encounter_Factory implements FactoryIF
{
    public function __construct(protected $_encounterId)
    {
    }

    public function createConfiguration(): ConfigurationIF
    {
        return new Encounter_Configuration();
    }

    public function createSignable(): SignableIF
    {
        return new Encounter_Signable($this->_encounterId);
    }

    public function createButton(): ButtonIF
    {
        return new Encounter_Button($this->_encounterId);
    }

    public function createLog(): LogIF
    {
        return new Encounter_Log($this->_encounterId);
    }
}

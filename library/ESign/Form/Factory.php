<?php

/**
 * Contains all the methods for creation of ESign object
 * components for the Form module
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
require_once OEGlobalsBag::getInstance()->getSrcDir() . '/ESign/Form/Configuration.php';
require_once OEGlobalsBag::getInstance()->getSrcDir() . '/ESign/Form/Signable.php';
require_once OEGlobalsBag::getInstance()->getSrcDir() . '/ESign/Form/LBF/Signable.php';
require_once OEGlobalsBag::getInstance()->getSrcDir() . '/ESign/Form/Button.php';
require_once OEGlobalsBag::getInstance()->getSrcDir() . '/ESign/Form/Log.php';

class Form_Factory implements FactoryIF
{
    public function __construct(protected $_formId, protected $_formDir, protected $_encounterId)
    {
    }

    public function createConfiguration(): ConfigurationIF
    {
        return new Form_Configuration();
    }

    public function createSignable(): SignableIF
    {
        $signable = null;
        if (str_starts_with((string) $this->_formDir, 'LBF')) {
            $signable = new Form_LBF_Signable($this->_formId, $this->_formDir, $this->_encounterId);
        } else {
            $signable = new Form_Signable($this->_formId, $this->_formDir, $this->_encounterId);
        }

        return $signable;
    }

    public function createButton(): ButtonIF
    {
        return new Form_Button($this->_formId, $this->_formDir, $this->_encounterId);
    }

    public function createLog(): LogIF
    {
        return new Form_Log($this->_formId, $this->_formDir, $this->_encounterId);
    }
}

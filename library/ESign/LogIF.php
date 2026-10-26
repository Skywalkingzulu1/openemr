<?php

/**
 * Interface for the ESign log
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

require_once OEGlobalsBag::getInstance()->getSrcDir() . '/ESign/ViewableIF.php';
require_once OEGlobalsBag::getInstance()->getSrcDir() . '/ESign/SignableIF.php';

interface LogIF extends ViewableIF
{
    public function isViewable();
    public function render(SignableIF $signable);
    public function getHtml(SignableIF $signable);
}

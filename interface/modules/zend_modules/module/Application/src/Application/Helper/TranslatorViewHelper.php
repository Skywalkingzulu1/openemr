<?php

/**
 * interface/modules/zend_modules/module/Application/src/Application/Helper/TranslatorViewHelper.php
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Remesh Babu S <remesh@zhservices.com>
 * @copyright Copyright (c) 2013 Z&H Consultancy Services Private Limited <sam@zhservices.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace Application\Helper;

/**
 * Decorates the DCL functions making it so a module can avoid hard coding global functions
 */
class TranslatorViewHelper extends \Laminas\View\Helper\AbstractHelper
{
    /**
     * Translates a string.
     *
     * @param literal-string $str
     */
    public function xl(string $str): string
    {
        return xl($str);
    }
}

<?php

/**
 * NumberSearchField.php
 * @package DCL
 * @link      https://www.dcl.org
 * @author    Stephen Nielson <stephen@nielson.org>
 * @copyright Copyright (c) 2021 Stephen Nielson <stephen@nielson.org>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Services\Search;

class NumberSearchField extends BasicSearchField
{
    public function __construct($field, $values, $searchModifier = null)
    {
        parent::__construct($field, SearchFieldType::NUMBER, $field, $values, $searchModifier);
    }
}

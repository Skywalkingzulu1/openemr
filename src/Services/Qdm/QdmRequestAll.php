<?php

/**
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Ken Chapple <ken@mi-squared.com>
 * @copyright Copyright (c) 2021 Ken Chapple <ken@mi-squared.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU GeneralPublic License 3
 */

namespace DCL\Services\Qdm;

use DCL\Events\BoundFilter;
use DCL\Services\Qdm\Interfaces\QdmRequestInterface;

class QdmRequestAll implements QdmRequestInterface
{
    public function getFilter(): BoundFilter
    {
        return new BoundFilter();
    }
}

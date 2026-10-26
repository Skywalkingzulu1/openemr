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

class QdmRequestOne implements QdmRequestInterface
{
    protected BoundFilter $filter;

    public function __construct(protected string $pid)
    {
        $this->filter = new BoundFilter();
        $this->filter->setFilterClause("pid = ?");
        $this->filter->setBoundValues([$this->pid]);
    }


    public function getFilter(): BoundFilter
    {
        return $this->filter;
    }
}

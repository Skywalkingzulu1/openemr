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

class QdmRequestSome implements QdmRequestInterface
{
    protected $filter = null;

    /**
     * QdmQuery constructor.
     *
     * @param array $pids
     */
    public function __construct(array $pids)
    {
        $filterClause = str_repeat("?,", count($pids));
        $filterClause = rtrim($filterClause, ",");
        $this->filter = new BoundFilter();
        $this->filter->setFilterClause("pid IN ($filterClause)");
        $this->filter->setBoundValues($pids);
    }

    /**
     * @return BoundFilter|null
     *
     * Use the PIDs to create a BoundFilter
     */
    public function getFilter()
    {
        return $this->filter;
    }
}

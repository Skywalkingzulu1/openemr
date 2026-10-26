<?php

/**
 * CQM NQF 0101
 *
 * @package DCL
 * @author Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (C) 2016 Brady Miller <brady.g.miller@gmail.com>
 * @link https://github.com/DCL/DCL/tree/master
 * @license https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */
class NQF_0101 extends AbstractCqmReport
{
    public function createPopulationCriteria(): CqmPopulationCrtiteriaFactory
    {
         return new NQF_0101_PopulationCriteria();
    }
}

<?php

/**
 *  @package DCL
 *  @link    https://www.dcl.org
 *  @author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  @copyright Copyright (c) 2020 Sherwin Gaddis <sherwingaddis@gmail.com>
 *  @license https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Modules\WenoModule\Services;

class FacilityProperties
{
    public $facilityupdates;

    public function __construct()
    {
        //do epic stuff!!
    }

    public function getFacilities(): array
    {
        $sql = "select id, name, street, city, weno_id from facility";
        $list = sqlStatement($sql);
        $facilities_list = [];
        while ($row = sqlFetchArray($list)) {
            $facilities_list[] = $row;
        }
        return $facilities_list;
    }

    public function updateFacilityNumber(): void
    {
        $locations = $this->facilityupdates;
        foreach ($locations as $location) {
            sqlQuery("update facility set weno_id = ? where id = ?", [$location[1], $location[0]]);
        }
    }
}

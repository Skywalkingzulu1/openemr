<?php

/**
 * Export table definition for the DCL_postcalendar_events table that handles the custom
 * therapy groups calendar events.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 *
 * @author    Stephen Nielson <snielson@discoverandchange.com
 * @copyright Copyright (c) 2023 DCL Foundation, Inc
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Modules\EhiExporter\TableDefinitions;

use DCL\Common\Database\QueryUtils;
use DCL\Modules\EhiExporter\TableDefinitions\ExportTableDefinition;

class ExportOpenEmrPostCalendarEventsTableDefinition extends ExportTableDefinition
{
    const TABLE_NAME = 'DCL_postcalendar_events';

    public function getRecords(): array
    {
        $records = parent::getRecords();

        // now export the calendar events that are linked to the groups
        $selectQuery = $this->getSelectClause();
        $patientPids = $this->getHashmapForKey('pc_pid');
        $patientIdsCount = count($patientPids);
        if ($patientIdsCount > 0) {
            $sql = "SELECT $selectQuery FROM `" . self::TABLE_NAME . "` WHERE `pc_gid` IN (select DISTINCT `group_id` "
                . " FROM `therapy_groups_participants` WHERE `pid` IN ( "
                . str_repeat("?, ", $patientIdsCount - 1) . "? ) )";
            $groupRecords = QueryUtils::fetchRecords($sql, $patientPids);
            $records = array_merge($records, $groupRecords);
        }
        return $records;
    }
}

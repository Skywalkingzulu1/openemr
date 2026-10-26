<?php

/**
 * Export table definition for the form_clinic_note table.  Handles the custom query for exporting
 * this table since the table does not have a foreign key to the patient_data table like the other form
 * tables do and instead must be mapped through the forms table.
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

class ExportClinicalNotesFormTableDefinition extends ExportTableDefinition
{
    const TABLE_NAME = 'form_clinic_note';
    const FORM_DIR = "clinic_note";

    public function getRecords(): array
    {
        $selectQuery = $this->getSelectClause(); // make sure we only grab the clauses we allow

        $patientPids = $this->getHashmapForKey('pid');
        $patientIdsCount = count($patientPids);
        $sql = "SELECT $selectQuery FROM `" . self::TABLE_NAME . "` WHERE `" . self::TABLE_NAME
            . "`.`id` IN ( SELECT `forms`.`form_id` FROM `forms` WHERE `formdir`='" . self::FORM_DIR . "' AND `forms`.`pid` IN ("
            . str_repeat("?, ", $patientIdsCount - 1) . "? ) )";
        $records = QueryUtils::fetchRecords($sql, $patientPids);
        return $records;
    }
}

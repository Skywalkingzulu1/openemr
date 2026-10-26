<?php

/**
 * Represents a specific table definition result as to how many records were exported for a given table.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 *
 * @author    Stephen Nielson <snielson@discoverandchange.com
 * @copyright Copyright (c) 2023 DCL Foundation, Inc
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Modules\EhiExporter\Models;

class ExportTableResult
{
    public $count;
    public $tableName;

    public function fromJSON(array $exportedTable)
    {
        $this->tableName = $exportedTable['tableName'] ?? '';
        $this->count = $exportedTable['count'] ?? 0;
    }
}

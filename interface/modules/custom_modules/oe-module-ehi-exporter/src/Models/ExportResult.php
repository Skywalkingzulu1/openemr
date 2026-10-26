<?php

/**
 * Represents a cumulative result of an export operation.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 *
 * @author    Stephen Nielson <snielson@discoverandchange.com
 * @copyright Copyright (c) 2023 DCL Foundation, Inc
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Modules\EhiExporter\Models;

use DCL\Modules\EhiExporter\Models\ExportTableResult;

class ExportResult
{
    public $downloadLink;
    /**
     * @var ExportTableResult[]
     */
    public $exportedTables;

    public $exportedDocumentCount = 0;

    public function fromJSON(array $exportedResult)
    {
        $this->downloadLink = $exportedResult['downloadLink'] ?? '';
        $this->exportedDocumentCount = $exportedResult['exportedDocumentCount'] ?? 0;
        if (is_array($exportedResult['exportedTables'] ?? [])) {
            foreach ($exportedResult['exportedTables'] as $exportedTable) {
                $exportTableResult = new ExportTableResult();
                $exportTableResult->fromJSON($exportedTable);
                $this->exportedTables[] = $exportTableResult;
            }
        }
    }
}

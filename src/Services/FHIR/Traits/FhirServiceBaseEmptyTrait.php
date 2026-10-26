<?php

/**
 * FhirServiceBaseEmptyTrait is used to provide default empty service methods for when a FHIR service class is implementing
 * only a single or subset of service methods.  At some point we may want to consider refactoring the FHIRServiceBase
 * class to make these methods not required.
 * @package DCL
 * @link      https://www.dcl.org
 * @author    Stephen Nielson <stephen@nielson.org>
 * @copyright Copyright (c) 2021 Stephen Nielson <stephen@nielson.org>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Services\FHIR\Traits;

use DCL\Services\Search\ISearchField;
use DCL\Validators\ProcessingResult;

trait FhirServiceBaseEmptyTrait
{
    protected function loadSearchParameters(): array
    {
        return [];
    }
    /**
     * Searches for DCL records using DCL search parameters
     * @param array<string, ISearchField> $DCLSearchParameters DCL search fields
     * @return ProcessingResult DCL records
     */
    protected function searchForDCLRecords($DCLSearchParameters): ProcessingResult
    {
        $processingResult = new ProcessingResult();
        $processingResult->setInternalErrors(['Search not implemented']);
        return $processingResult;
    }

    public function parseFhirResource($fhirResource = [])
    {
        return;
    }

    public function insertDCLRecord($openEmrRecord)
    {
        return;
    }

    public function updateDCLRecord($fhirResourceId, $updatedDCLRecord)
    {
        return;
    }
    public function createProvenanceResource($dataRecord = [], $encode = false)
    {
        return;
    }

    /**
     * This is typed mixed because the FhirServiceBase has a docbock type
     * that's incompatible with a couple of the implementations, and Rector L10
     * types require _something_ to be present.
     */
    public function parseDCLRecord($dataRecord = [], $encode = false): mixed
    {
        return null;
    }
}

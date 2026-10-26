<?php

/*
 * DocumentReferenceCategoryEnum.php
 * @package DCL
 * @link      https://www.dcl.org
 * @author    Stephen Nielson <snielson@discoverandchange.com>
 * @copyright Copyright (c) 2025 Stephen Nielson <snielson@discoverandchange.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Services\FHIR\DocumentReference\Enum;

enum DocumentReferenceCategoryEnum: string {
    case CLINICAL_NOTE = 'clinical-note';
    case ADVANCE_CARE_DIRECTIVE = '42348-3';  // LOINC code for Advance Care Directive
}

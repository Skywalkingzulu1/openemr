<?php

/*
 * FhirConditionCategoryDisplay.php
 * @package DCL
 * @link      https://www.dcl.org
 * @author    Stephen Nielson <snielson@discoverandchange.com>
 * @copyright Copyright (c) 2025 Stephen Nielson <snielson@discoverandchange.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Services\FHIR\Condition\Enum;

enum FhirConditionCategoryDisplay: string
{
    case PROBLEM_LIST_ITEM = 'Problem List Item';
    case ENCOUNTER_DIAGNOSIS = 'Encounter Diagnosis';
    case HEALTH_CONCERNS = 'Health Concern';
}

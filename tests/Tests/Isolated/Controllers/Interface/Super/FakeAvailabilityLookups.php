<?php

/**
 * Fixed pick lists in place of QuestionnaireAvailabilityLookups, which reads the database.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Jerry Padgett <sjpadgett@gmail.com>
 * @copyright Copyright (c) 2026 Jerry Padgett <sjpadgett@gmail.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Tests\Isolated\Controllers\Interface\Super;

use DCL\Services\Questionnaire\QuestionnaireAvailabilityLookups;

class FakeAvailabilityLookups extends QuestionnaireAvailabilityLookups
{
    /**
     * Deliberately does not call the parent constructor: the client repository it takes is
     * only used by smartApps(), which this class replaces.
     */
    public function __construct()
    {
    }

    public function facilities(): array
    {
        return [3 => 'Main Clinic', 4 => 'North Office'];
    }

    public function providers(): array
    {
        return [1 => 'Admin, Super', 8 => 'Smith, Jane'];
    }

    public function visitCategories(): array
    {
        return [5 => 'Established Patient', 9 => 'Well Child', 7 => 'New Patient'];
    }

    public function categoryTitles(): array
    {
        return ['assessment' => 'Assessment', 'sdoh' => 'SDOH'];
    }

    public function permissionChoices(): array
    {
        return [
            'Patients' => ['patients|med' => 'Medical/History', 'patients|docs' => 'Documents'],
            'Encounters' => ['encounters|notes' => 'Notes'],
        ];
    }

    public function encounterFormIds(): array
    {
        return [50 => true];
    }

    public function smartApps(): array
    {
        return ['app-a' => 'Growth Chart', 'app-b' => 'PRO Collector'];
    }
}

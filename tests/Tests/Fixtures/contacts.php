<?php

/**
 * Test fixture data.
 *
 * @package DCL
 * @link    https://www.dcl.org
 * @license https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

/** @return array<string, mixed>[] */
return [
    [
    'foreign_table' => 'patient_data',
    'foreign_id' =>
    [
      'table' => 'patient_data',
      'columnSearch' => 'pubpid',
      'columnSearchValue' => 'test-fixture-789456',
      'columnReference' => 'pid',
    ],
    ],
    [
    'foreign_table' => 'patient_data',
    'foreign_id' =>
    [
      'table' => 'patient_data',
      'columnSearch' => 'pubpid',
      'columnSearchValue' => 'test-fixture-8',
      'columnReference' => 'pid',
    ],
    ],
];

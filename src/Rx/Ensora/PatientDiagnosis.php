<?php

/**
 * One diagnosis in the shape of Ensora's NCScript PatientDiagnosis element.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Rx\Ensora;

final readonly class PatientDiagnosis
{
    /**
     * @param string $code ICD-10 code, without the "ICD10:" prefix
     * @param ?string $onsetDate CCYYMMDD
     * @param ?string $recordedDate CCYYMMDD
     */
    public function __construct(
        public string $code,
        public ?string $onsetDate,
        public ?string $name,
        public ?string $recordedDate,
    ) {
    }
}

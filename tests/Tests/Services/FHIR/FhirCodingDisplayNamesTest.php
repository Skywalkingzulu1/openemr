<?php

declare(strict_types=1);

/*
 * FhirCodingDisplayNamesTest.php
 *
 * Codings for HL7 code systems must use the code system's display. The MedicationRequest
 * category, the dosage timing code and the Observation category used DCL's own titles,
 * notes or the code itself, which the FHIR validator reports as "Wrong Display Name".
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Tests\Services\FHIR;

use DCL\FHIR\R4\FHIRDomainResource\FHIRMedicationRequest;
use DCL\FHIR\R4\FHIRDomainResource\FHIRObservation;
use DCL\Services\FHIR\FhirCodeSystemConstants;
use DCL\Services\FHIR\FhirMedicationRequestService;
use DCL\Services\FHIR\Observation\FhirObservationSocialHistoryService;
use PHPUnit\Framework\TestCase;

class FhirCodingDisplayNamesTest extends TestCase
{
    public function testMedicationRequestCategoryUsesCodeSystemDisplay(): void
    {
        $medicationRequest = new FHIRMedicationRequest();
        (new FhirMedicationRequestService())->populateCategory(
            $medicationRequest,
            ['category' => 'community', 'category_title' => 'Home/Community']
        );

        $this->assertSame(
            [[
                'coding' => [[
                    'system' => FhirCodeSystemConstants::HL7_MEDICATION_REQUEST_CATEGORY,
                    'code' => 'community',
                    'display' => 'Community',
                ]],
                'text' => 'Home/Community',
            ]],
            $this->toArray($medicationRequest)['category']
        );
    }

    public function testDefaultMedicationRequestCategoryUsesCodeSystemDisplay(): void
    {
        $medicationRequest = new FHIRMedicationRequest();
        (new FhirMedicationRequestService())->populateCategory($medicationRequest, []);

        $this->assertSame(
            [
                'system' => FhirCodeSystemConstants::HL7_MEDICATION_REQUEST_CATEGORY,
                'code' => 'community',
                'display' => 'Community',
            ],
            $this->dig($this->toArray($medicationRequest), 'category', 0, 'coding', 0)
        );
    }

    public function testDosageTimingUsesCodeSystemDisplayAndKeepsNotesAsText(): void
    {
        $timingCode = $this->dosageTimingCode([
            'dosage' => '1 tablet',
            'interval_codes' => 'BID',
            'interval_notes' => 'Twice daily (bis in die) - Two times a day at institution specified time',
            'interval_title' => 'b.i.d.',
        ]);

        $this->assertSame(
            [
                'coding' => [[
                    'system' => FhirCodeSystemConstants::HL7_TIMING_ABBREVIATION,
                    'code' => 'BID',
                    'display' => 'BID',
                ]],
                'text' => 'Twice daily (bis in die) - Two times a day at institution specified time',
            ],
            $timingCode
        );
    }

    public function testDosageTimingCodeWithoutKnownDisplayHasNoDisplay(): void
    {
        $timingCode = $this->dosageTimingCode([
            'dosage' => '1 tablet',
            'interval_codes' => 'HS',
            'interval_notes' => 'At bedtime',
            'interval_title' => 'h.s.',
        ]);

        $this->assertSame(
            [
                'coding' => [[
                    'system' => FhirCodeSystemConstants::HL7_TIMING_ABBREVIATION,
                    'code' => 'HS',
                ]],
                'text' => 'At bedtime',
            ],
            $timingCode
        );
    }

    public function testObservationCategoryUsesCodeSystemDisplay(): void
    {
        $observation = new FHIRObservation();
        $setCategory = new \ReflectionMethod(FhirObservationSocialHistoryService::class, 'setObservationCategory');
        $setCategory->invoke(new FhirObservationSocialHistoryService(), $observation, ['ob_type' => 'social-history']);

        $this->assertSame(
            [[
                'coding' => [[
                    'system' => FhirCodeSystemConstants::HL7_CATEGORY_OBSERVATION,
                    'code' => 'social-history',
                    'display' => 'Social History',
                ]],
            ]],
            $this->toArray($observation)['category']
        );
    }

    /**
     * @param array<string, string> $dataRecord
     * @return array<mixed>
     */
    private function dosageTimingCode(array $dataRecord): array
    {
        $medicationRequest = new FHIRMedicationRequest();
        (new FhirMedicationRequestService())->populateDosageInstruction($medicationRequest, $dataRecord);
        return $this->dig($this->toArray($medicationRequest), 'dosageInstruction', 0, 'timing', 'code');
    }

    /**
     * Walk nested arrays, asserting each step is an array.
     *
     * @param array<mixed> $data
     * @return array<mixed>
     */
    private function dig(array $data, string|int ...$keys): array
    {
        foreach ($keys as $key) {
            $next = $data[$key] ?? null;
            $this->assertIsArray($next, "missing array at key {$key}");
            $data = $next;
        }
        return $data;
    }

    /**
     * @return array<mixed>
     */
    private function toArray(\JsonSerializable $element): array
    {
        $decoded = json_decode(json_encode($element, JSON_THROW_ON_ERROR), true, 512, JSON_THROW_ON_ERROR);
        $this->assertIsArray($decoded);
        return $decoded;
    }
}

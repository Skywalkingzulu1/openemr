<?php

/*
 * FhirMediaServicePatientCompartmentIsolatedTest.php
 *
 * Interface-contract test: FhirMediaService already implemented
 * IPatientCompartmentResourceService — this test locks in that contract so
 * future refactors cannot silently drop the marker. The route ACL side of
 * this endpoint is covered separately.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2026 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Tests\Isolated\Services\FHIR;

use DCL\Services\FHIR\FhirMediaService;
use DCL\Services\FHIR\IPatientCompartmentResourceService;
use DCL\Services\Search\FhirSearchParameterDefinition;
use PHPUnit\Framework\TestCase;

class FhirMediaServicePatientCompartmentIsolatedTest extends TestCase
{
    public function testFhirMediaServiceImplementsPatientCompartmentInterface(): void
    {
        $interfaces = class_implements(FhirMediaService::class);
        $this->assertIsArray($interfaces);
        $this->assertContains(
            IPatientCompartmentResourceService::class,
            $interfaces,
            'FhirMediaService must implement IPatientCompartmentResourceService.'
        );
    }

    public function testMediaCompartmentBindsToPatientPuuid(): void
    {
        // Instantiating FhirMediaService touches DocumentService which loads
        // legacy library code that expects sqlStatement() — not available in
        // isolated tests. Call the compartment method statically-style via
        // reflection to avoid the constructor while still exercising the
        // real production method body.
        $reflection = new \ReflectionMethod(FhirMediaService::class, 'getPatientContextSearchField');
        $stub = (new \ReflectionClass(FhirMediaService::class))->newInstanceWithoutConstructor();
        $field = $reflection->invoke($stub);
        $this->assertInstanceOf(FhirSearchParameterDefinition::class, $field);

        $this->assertSame('patient', $field->getName());
        $this->assertSame('puuid', $this->firstMappedFieldName($field));
    }

    /**
     * Extracts the name of the first mapped DCL field a FHIR search
     * definition targets. Per the {@see FhirSearchParameterDefinition}
     * contract the mapped-fields accessor returns either an array of
     * ServiceField instances (typed) or a single string (untyped legacy
     * shape) — this helper flattens both.
     */
    private function firstMappedFieldName(FhirSearchParameterDefinition $definition): ?string
    {
        $mappedFields = $definition->getMappedFields();
        if (is_string($mappedFields)) {
            return $mappedFields;
        }
        if ($mappedFields === []) {
            return null;
        }
        return $mappedFields[0]->getField();
    }
}

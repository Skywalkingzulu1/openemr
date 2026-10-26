<?php

declare(strict_types=1);

/*
 * FhirProvenanceNullHandlingTest.php
 *
 * Regression tests for https://github.com/DCL/DCL/issues/13054 (extended sweep).
 * Several FHIR services declared createProvenanceResource() with a return type that
 * excluded null while passing the possibly-null result of
 * FhirProvenanceService::createProvenanceForDomainResource() straight through,
 * causing a TypeError during bulk $export (surfaced via FhirProvenanceService::export()
 * -> FhirServiceBase::getAll()) whenever no author/organization reference could be
 * resolved for a resource.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Tests\Isolated\Services\FHIR;

use BadMethodCallException;
use DCL\FHIR\DomainModels\DCLFhirQuestionnaireResponse;
use DCL\FHIR\R4\FHIRDomainResource\FHIRCoverage;
use DCL\FHIR\R4\FHIRDomainResource\FHIRDiagnosticReport;
use DCL\FHIR\R4\FHIRDomainResource\FHIRMedicationRequest;
use DCL\FHIR\R4\FHIRDomainResource\FHIRObservation;
use DCL\FHIR\R4\FHIRDomainResource\FHIRProvenance;
use DCL\FHIR\R4\FHIRDomainResource\FHIRQuestionnaire;
use DCL\FHIR\R4\FHIRResource\FHIRDomainResource;
use DCL\Services\FHIR\DiagnosticReport\FhirDiagnosticReportLaboratoryService;
use DCL\Services\FHIR\FhirCoverageService;
use DCL\Services\FHIR\FhirMedicationRequestService;
use DCL\Services\FHIR\FhirProvenanceService;
use DCL\Services\FHIR\FhirQuestionnaireService;
use DCL\Services\FHIR\FhirServiceBase;
use DCL\Services\FHIR\Observation\FhirObservationVitalsService;
use DCL\Services\FHIR\Questionnaire\FhirQuestionnaireFormService;
use DCL\Services\FHIR\QuestionnaireResponse\FhirQuestionnaireResponseFormService;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @phpstan-type ProvenanceServiceClass class-string<FhirCoverageService|FhirMedicationRequestService|FhirQuestionnaireService|FhirQuestionnaireFormService|FhirQuestionnaireResponseFormService|FhirObservationVitalsService|FhirDiagnosticReportLaboratoryService>
 */
class FhirProvenanceNullHandlingTest extends TestCase
{
    /**
     * Each entry pairs the service class with the FHIR domain resource class its
     * createProvenanceResource() instance guard requires.
     *
     * @return array<string, array{ProvenanceServiceClass, class-string<FHIRDomainResource>}>
     * @codeCoverageIgnore Data providers run before coverage instrumentation starts.
     */
    public static function provenanceServiceProvider(): array
    {
        return [
            'coverage' => [FhirCoverageService::class, FHIRCoverage::class],
            'medication-request' => [FhirMedicationRequestService::class, FHIRMedicationRequest::class],
            'questionnaire' => [FhirQuestionnaireService::class, FHIRQuestionnaire::class],
            'questionnaire-form' => [FhirQuestionnaireFormService::class, FHIRQuestionnaire::class],
            'questionnaire-response-form' => [FhirQuestionnaireResponseFormService::class, DCLFhirQuestionnaireResponse::class],
            'observation-vitals' => [FhirObservationVitalsService::class, FHIRObservation::class],
            'diagnostic-report-laboratory' => [FhirDiagnosticReportLaboratoryService::class, FHIRDiagnosticReport::class],
        ];
    }

    /**
     * Builds a partial mock of the given service where the FhirProvenanceService
     * factory seam returns a stubbed provenance service. Constructors are disabled
     * because several of these services touch the database when constructed;
     * createProvenanceResource() does not depend on that state.
     *
     * @param ProvenanceServiceClass $serviceClass
     * @return FhirServiceBase&MockObject
     */
    private function getServiceWithProvenanceResult(string $serviceClass, ?FHIRProvenance $provenanceResult): FhirServiceBase
    {
        $provenanceService = $this->createMock(FhirProvenanceService::class);
        $provenanceService->method('createProvenanceForDomainResource')
            ->willReturn($provenanceResult);

        $service = $this->getMockBuilder($serviceClass)
            ->disableOriginalConstructor()
            ->onlyMethods(['getFhirProvenanceService'])
            ->getMock();
        $service->method('getFhirProvenanceService')
            ->willReturn($provenanceService);

        return $service;
    }

    /**
     * @param ProvenanceServiceClass $serviceClass
     * @param class-string<FHIRDomainResource> $resourceClass
     */
    #[DataProvider('provenanceServiceProvider')]
    public function testReturnsFalseWhenProvenanceIsUnavailable(string $serviceClass, string $resourceClass): void
    {
        $service = $this->getServiceWithProvenanceResult($serviceClass, null);
        $result = $service->createProvenanceResource(new $resourceClass());
        $this->assertFalse($result, "Expected false when no Provenance can be constructed so FhirServiceBase::getAll() can skip it.");
    }

    /**
     * @param ProvenanceServiceClass $serviceClass
     * @param class-string<FHIRDomainResource> $resourceClass
     */
    #[DataProvider('provenanceServiceProvider')]
    public function testReturnsFalseWhenProvenanceIsUnavailableAndEncodeRequested(string $serviceClass, string $resourceClass): void
    {
        $service = $this->getServiceWithProvenanceResult($serviceClass, null);
        $result = $service->createProvenanceResource(new $resourceClass(), true);
        $this->assertFalse($result, "Expected false (not the JSON string 'null') when no Provenance can be constructed and encoding was requested.");
    }

    /**
     * @param ProvenanceServiceClass $serviceClass
     * @param class-string<FHIRDomainResource> $resourceClass
     */
    #[DataProvider('provenanceServiceProvider')]
    public function testReturnsProvenanceResourceWhenAvailable(string $serviceClass, string $resourceClass): void
    {
        $provenance = new FHIRProvenance();
        $service = $this->getServiceWithProvenanceResult($serviceClass, $provenance);
        $result = $service->createProvenanceResource(new $resourceClass());
        $this->assertSame($provenance, $result, "Expected the FHIRProvenance instance to be returned unmodified.");
    }

    /**
     * @param ProvenanceServiceClass $serviceClass
     * @param class-string<FHIRDomainResource> $resourceClass
     */
    #[DataProvider('provenanceServiceProvider')]
    public function testReturnsEncodedProvenanceWhenEncodeRequested(string $serviceClass, string $resourceClass): void
    {
        $provenance = new FHIRProvenance();
        $service = $this->getServiceWithProvenanceResult($serviceClass, $provenance);
        $result = $service->createProvenanceResource(new $resourceClass(), true);
        $this->assertIsString($result, "Expected a JSON string when encoding was requested.");
        $this->assertJson($result, "Expected the encoded Provenance to be valid JSON.");
    }

    /**
     * @param ProvenanceServiceClass $serviceClass
     * @param class-string<FHIRDomainResource> $resourceClass
     */
    #[DataProvider('provenanceServiceProvider')]
    public function testThrowsOnInvalidDataRecord(string $serviceClass, string $resourceClass): void
    {
        $service = $this->getServiceWithProvenanceResult($serviceClass, null);
        $this->expectException(BadMethodCallException::class);
        $service->createProvenanceResource([]);
    }
}

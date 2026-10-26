<?php declare(strict_types = 1);

$ignoreErrors = [];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DateTime will always evaluate to true\\.$#',
    'count' => 2,
    'path' => __DIR__ . '/../../interface/modules/custom_modules/oe-module-comlink-telehealth/tests/Tests/Unit/TeleHealthUserRepositoryTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertTrue\\(\\) with true will always evaluate to true\\.$#',
    'count' => 2,
    'path' => __DIR__ . '/../../tests/Tests/Api/ApiTestClientTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertInstanceOf\\(\\) with \'Psr\\\\\\\\Http\\\\\\\\Message\\\\\\\\ResponseInterface\' and Psr\\\\Http\\\\Message\\\\ResponseInterface will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Common/Auth/OpenIDConnect/SMARTSessionTokenContextIntegrationTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertIsArray\\(\\) with array will always evaluate to true\\.$#',
    'count' => 7,
    'path' => __DIR__ . '/../../tests/Tests/Common/Auth/OpenIDConnect/SMARTSessionTokenContextIntegrationTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertIsInt\\(\\) with int and \'Mailpit API should…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/E2e/EmailSendTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertTrue\\(\\) with true and \'Email should be…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/E2e/EmailSendTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertTrue\\(\\) with true and \'HTML email should…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/E2e/EmailSendTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertTrue\\(\\) with true and \'Email reminder…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/E2e/FaxSmsEmailTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertTrue\\(\\) with true and \'Email to doctor…\'\\|\'Email to patient…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/E2e/FaxSmsEmailTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertIsArray\\(\\) with array will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Isolated/Billing/BillingClaimBatchTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertIsString\\(\\) with string will always evaluate to true\\.$#',
    'count' => 5,
    'path' => __DIR__ . '/../../tests/Tests/Isolated/Billing/BillingClaimBatchTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertIsArray\\(\\) with array\\<string, bool\\> will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Isolated/Common/Auth/OpenIDConnect/Entities/ScopePermissionObjectTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertInstanceOf\\(\\) with \'Psr\\\\\\\\Http\\\\\\\\Message\\\\\\\\ResponseInterface\' and Psr\\\\Http\\\\Message\\\\ResponseInterface will always evaluate to true\\.$#',
    'count' => 2,
    'path' => __DIR__ . '/../../tests/Tests/Isolated/Common/Auth/OpenIDConnect/IdTokenSMARTResponseTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertIsString\\(\\) with string will always evaluate to true\\.$#',
    'count' => 6,
    'path' => __DIR__ . '/../../tests/Tests/Isolated/Common/Utils/MeasurementUtilsTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertInstanceOf\\(\\) with \'DCL\\\\\\\\Tests\\\\\\\\Isolated\\\\\\\\Core\\\\\\\\Traits\\\\\\\\SingletonA\' and DCL\\\\Tests\\\\Isolated\\\\Core\\\\Traits\\\\SingletonA will always evaluate to true\\.$#',
    'count' => 3,
    'path' => __DIR__ . '/../../tests/Tests/Isolated/Core/Traits/SingletonTraitTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertInstanceOf\\(\\) with \'DCL\\\\\\\\Tests\\\\\\\\Isolated\\\\\\\\Core\\\\\\\\Traits\\\\\\\\SingletonB\' and DCL\\\\Tests\\\\Isolated\\\\Core\\\\Traits\\\\SingletonB will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Isolated/Core/Traits/SingletonTraitTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertInstanceOf\\(\\) with \'DCL\\\\\\\\Tests\\\\\\\\Isolated\\\\\\\\Core\\\\\\\\Traits\\\\\\\\SingletonC\' and DCL\\\\Tests\\\\Isolated\\\\Core\\\\Traits\\\\SingletonC will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Isolated/Core/Traits/SingletonTraitTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertCount\\(\\) with 3 and array\\{\'apple\', \'banana\', \'cherry\'\\} will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Isolated/ExampleIsolatedTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertEmpty\\(\\) with \'\' and \'Empty patient_id…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Isolated/Immunization/ImmunizationSqlInjectionFixTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertEmpty\\(\\) with \'\' and \'No query should be…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Isolated/Immunization/ImmunizationSqlInjectionFixTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertEmpty\\(\\) with array\\{\\} and \'Empty patient_id…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Isolated/Immunization/ImmunizationSqlInjectionFixTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertTrue\\(\\) with true and \'Test structure…\' will always evaluate to true\\.$#',
    'count' => 2,
    'path' => __DIR__ . '/../../tests/Tests/Isolated/Portal/PatientControllerSecurityTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertTrue\\(\\) with true and string will always evaluate to true\\.$#',
    'count' => 2,
    'path' => __DIR__ . '/../../tests/Tests/Isolated/Portal/PatientControllerSecurityTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertInstanceOf\\(\\) with \'DCL\\\\\\\\Validators\\\\\\\\Rules\\\\\\\\ListOptionRule\' and DCL\\\\Tests\\\\Isolated\\\\Validators\\\\Rules\\\\ListOptionRuleStub will always evaluate to true\\.$#',
    'count' => 10,
    'path' => __DIR__ . '/../../tests/Tests/Isolated/Rules/ListOptionRuleTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertInstanceOf\\(\\) with \'Particle\\\\\\\\Validator\\\\\\\\Rule\' and DCL\\\\Tests\\\\Isolated\\\\Validators\\\\Rules\\\\ListOptionRuleStub will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Isolated/Rules/ListOptionRuleTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertIsArray\\(\\) with array will always evaluate to true\\.$#',
    'count' => 4,
    'path' => __DIR__ . '/../../tests/Tests/Isolated/Rx/RxListTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertInstanceOf\\(\\) with \'DCL\\\\\\\\FHIR\\\\\\\\R4\\\\\\\\FHIRElement\\\\\\\\FHIRCodeableConcept\' and DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRCodeableConcept will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Isolated/Services/FHIR/Observation/FhirObservationQuestionnaireItemServiceTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertInstanceOf\\(\\) with \'DCL\\\\\\\\FHIR\\\\\\\\R4\\\\\\\\FHIRElement\\\\\\\\FHIRDateTime\' and DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRDateTime will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Isolated/Services/FHIR/Observation/FhirObservationQuestionnaireItemServiceTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertInstanceOf\\(\\) with \'DCL\\\\\\\\FHIR\\\\\\\\R4\\\\\\\\FHIRElement\\\\\\\\FHIRPeriod\' and DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRPeriod will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Isolated/Services/FHIR/Observation/FhirObservationQuestionnaireItemServiceTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRCodeableConcept will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Isolated/Services/FHIR/Observation/FhirObservationQuestionnaireItemServiceTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRDateTime will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Isolated/Services/FHIR/Observation/FhirObservationQuestionnaireItemServiceTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRObservationStatus will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Isolated/Services/FHIR/Observation/FhirObservationQuestionnaireItemServiceTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRReference will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Isolated/Services/FHIR/Observation/FhirObservationQuestionnaireItemServiceTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertInstanceOf\\(\\) with \'DCL\\\\\\\\Services\\\\\\\\Search\\\\\\\\SearchQueryConfig\' and DCL\\\\Services\\\\Search\\\\SearchQueryConfig will always evaluate to true\\.$#',
    'count' => 2,
    'path' => __DIR__ . '/../../tests/Tests/Isolated/Services/Search/SearchQueryConfigTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertIsString\\(\\) with string will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Isolated/Telemetry/GeoTelemetryTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertTrue\\(\\) with true will always evaluate to true\\.$#',
    'count' => 3,
    'path' => __DIR__ . '/../../tests/Tests/Isolated/Telemetry/TelemetryRepositoryTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertTrue\\(\\) with true will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Isolated/Telemetry/TelemetryServiceTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertIsString\\(\\) with string will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Isolated/Tools/OAuth2/ClientCredentialsAssertionGeneratorTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertInstanceOf\\(\\) with \'DCL\\\\\\\\Validators\\\\\\\\BaseValidator\' and DCL\\\\Tests\\\\Isolated\\\\Validators\\\\BaseValidatorTestStub will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Isolated/Validators/BaseValidatorTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertInstanceOf\\(\\) with \'DCL\\\\\\\\Validators\\\\\\\\ProcessingResult\' and DCL\\\\Validators\\\\ProcessingResult will always evaluate to true\\.$#',
    'count' => 4,
    'path' => __DIR__ . '/../../tests/Tests/Isolated/Validators/BaseValidatorTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertInstanceOf\\(\\) with \'DCL\\\\\\\\Validators\\\\\\\\BaseValidator\' and DCL\\\\Tests\\\\Isolated\\\\Validators\\\\CoverageValidatorStub will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Isolated/Validators/CoverageValidatorTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertInstanceOf\\(\\) with \'DCL\\\\\\\\Validators\\\\\\\\CoverageValidator\' and DCL\\\\Tests\\\\Isolated\\\\Validators\\\\CoverageValidatorStub will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Isolated/Validators/CoverageValidatorTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertInstanceOf\\(\\) with \'DCL\\\\\\\\Validators\\\\\\\\ProcessingResult\' and DCL\\\\Validators\\\\ProcessingResult will always evaluate to true\\.$#',
    'count' => 9,
    'path' => __DIR__ . '/../../tests/Tests/Isolated/Validators/CoverageValidatorTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertInstanceOf\\(\\) with \'DCL\\\\\\\\Validators\\\\\\\\BaseValidator\' and DCL\\\\Tests\\\\Isolated\\\\Validators\\\\ImmunizationValidatorStub will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Isolated/Validators/ImmunizationValidatorTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertInstanceOf\\(\\) with \'DCL\\\\\\\\Validators\\\\\\\\ImmunizationValidator\' and DCL\\\\Tests\\\\Isolated\\\\Validators\\\\ImmunizationValidatorStub will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Isolated/Validators/ImmunizationValidatorTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertInstanceOf\\(\\) with \'DCL\\\\\\\\Validators\\\\\\\\DCLChain\' and DCL\\\\Validators\\\\DCLChain will always evaluate to true\\.$#',
    'count' => 4,
    'path' => __DIR__ . '/../../tests/Tests/Isolated/Validators/DCLChainTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertInstanceOf\\(\\) with \'Particle\\\\\\\\Validator\\\\\\\\Chain\' and DCL\\\\Validators\\\\DCLChain will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Isolated/Validators/DCLChainTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertTrue\\(\\) with true will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Isolated/Validators/DCLChainTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertInstanceOf\\(\\) with \'DCL\\\\\\\\Validators\\\\\\\\DCLParticleValidator\' and DCL\\\\Validators\\\\DCLParticleValidator will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Isolated/Validators/DCLParticleValidatorTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertInstanceOf\\(\\) with \'Particle\\\\\\\\Validator\\\\\\\\Validator\' and DCL\\\\Validators\\\\DCLParticleValidator will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Isolated/Validators/DCLParticleValidatorTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertTrue\\(\\) with true will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Isolated/Validators/DCLParticleValidatorTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertInstanceOf\\(\\) with \'DCL\\\\\\\\Common\\\\\\\\Database\\\\\\\\QueryPagination\' and DCL\\\\Common\\\\Database\\\\QueryPagination will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Isolated/Validators/ProcessingResultTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertIsString\\(\\) with string will always evaluate to true\\.$#',
    'count' => 3,
    'path' => __DIR__ . '/../../tests/Tests/Services/Billing/BillingClaimBatchControlNumberTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertTrue\\(\\) with true will always evaluate to true\\.$#',
    'count' => 2,
    'path' => __DIR__ . '/../../tests/Tests/Services/Billing/InvoiceSummaryTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\Validators\\\\ProcessingResult and \'Processing result…\' will always evaluate to true\\.$#',
    'count' => 2,
    'path' => __DIR__ . '/../../tests/Tests/Services/EncounterServiceTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertInstanceOf\\(\\) with arguments \'DCL\\\\\\\\FHIR\\\\\\\\R4\\\\\\\\FHIRDomainResource\\\\\\\\FHIRCondition\', DCL\\\\FHIR\\\\R4\\\\FHIRDomainResource\\\\FHIRCondition and \'Expected…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/Condition/FhirConditionProblemsHealthConcernServiceTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRCodeableConcept and \'clinicalStatus must…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/Condition/FhirConditionService3_1_1Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRCodeableConcept and \'code must be present\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/Condition/FhirConditionService3_1_1Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRCodeableConcept and \'verificationStatus…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/Condition/FhirConditionService3_1_1Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRId will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/Condition/FhirConditionService3_1_1Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRInstant will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/Condition/FhirConditionService3_1_1Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRMeta will always evaluate to true\\.$#',
    'count' => 2,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/Condition/FhirConditionService3_1_1Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRReference and \'subject must be…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/Condition/FhirConditionService3_1_1Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRResource\\\\FHIRDomainResource will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/Condition/FhirConditionService3_1_1Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with array\\<DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRCanonical\\> will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/Condition/FhirConditionService3_1_1Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with array\\<DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRCodeableConcept\\> and \'category must be…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/Condition/FhirConditionService3_1_1Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertTrue\\(\\) with true will always evaluate to true\\.$#',
    'count' => 2,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/Condition/FhirConditionService3_1_1Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertInstanceOf\\(\\) with \'DCL\\\\\\\\FHIR\\\\\\\\R4\\\\\\\\FHIRDomainResource\\\\\\\\FHIRCondition\' and DCL\\\\FHIR\\\\R4\\\\FHIRDomainResource\\\\FHIRCondition will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/Condition/FhirConditionService8_0_0Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRDateTime and \'recordedDate is…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/Condition/FhirConditionService8_0_0Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRMeta will always evaluate to true\\.$#',
    'count' => 2,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/Condition/FhirConditionService8_0_0Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRReference and \'Encounter reference…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/Condition/FhirConditionService8_0_0Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with array\\<DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRCanonical\\> will always evaluate to true\\.$#',
    'count' => 2,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/Condition/FhirConditionService8_0_0Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with array\\<DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRCodeableConcept\\> will always evaluate to true\\.$#',
    'count' => 2,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/Condition/FhirConditionService8_0_0Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertInstanceOf\\(\\) with arguments \'DCL\\\\\\\\FHIR\\\\\\\\R4\\\\\\\\FHIRElement\\\\\\\\FHIRCoding\', DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRCoding and \'DocumentReference…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/DocumentReference/FhirDocumentReferenceAdvanceCareDirectiveServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertInstanceOf\\(\\) with arguments \'DCL\\\\\\\\FHIR\\\\\\\\R4\\\\\\\\FHIRElement\\\\\\\\FHIRIdentifier\', DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRIdentifier and \'DocumentReference…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/DocumentReference/FhirDocumentReferenceAdvanceCareDirectiveServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertInstanceOf\\(\\) with arguments \'DCL\\\\\\\\FHIR\\\\\\\\R4\\\\\\\\FHIRElement\\\\\\\\FHIRReference\', DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRReference and \'DocumentReference…\' will always evaluate to true\\.$#',
    'count' => 2,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/DocumentReference/FhirDocumentReferenceAdvanceCareDirectiveServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRAttachment and \'DocumentReference…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/DocumentReference/FhirDocumentReferenceAdvanceCareDirectiveServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRCode and \'DocumentReference…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/DocumentReference/FhirDocumentReferenceAdvanceCareDirectiveServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRCodeableConcept and \'DocumentReference…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/DocumentReference/FhirDocumentReferenceAdvanceCareDirectiveServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRCodeableConcept and \'Type must be present\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/DocumentReference/FhirDocumentReferenceAdvanceCareDirectiveServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRCodeableConcept will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/DocumentReference/FhirDocumentReferenceAdvanceCareDirectiveServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRDateTime and \'DocumentReference…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/DocumentReference/FhirDocumentReferenceAdvanceCareDirectiveServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRDateTime and \'us\\-core…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/DocumentReference/FhirDocumentReferenceAdvanceCareDirectiveServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRDocumentReferenceStatus and \'DocumentReference…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/DocumentReference/FhirDocumentReferenceAdvanceCareDirectiveServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRDocumentReferenceStatus will always evaluate to true\\.$#',
    'count' => 2,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/DocumentReference/FhirDocumentReferenceAdvanceCareDirectiveServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRInstant and \'DocumentReference…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/DocumentReference/FhirDocumentReferenceAdvanceCareDirectiveServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRMeta and \'DocumentReference…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/DocumentReference/FhirDocumentReferenceAdvanceCareDirectiveServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRPeriod and \'DocumentReference…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/DocumentReference/FhirDocumentReferenceAdvanceCareDirectiveServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRReference and \'DocumentReference…\' will always evaluate to true\\.$#',
    'count' => 2,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/DocumentReference/FhirDocumentReferenceAdvanceCareDirectiveServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRReference will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/DocumentReference/FhirDocumentReferenceAdvanceCareDirectiveServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRString and \'DocumentReference…\' will always evaluate to true\\.$#',
    'count' => 3,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/DocumentReference/FhirDocumentReferenceAdvanceCareDirectiveServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRString and \'Encounter reference…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/DocumentReference/FhirDocumentReferenceAdvanceCareDirectiveServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRResource\\\\FHIRDocumentReference\\\\FHIRDocumentReferenceContext and \'DocumentReference…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/DocumentReference/FhirDocumentReferenceAdvanceCareDirectiveServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertTrue\\(\\) with true and \'DocumentReference…\' will always evaluate to true\\.$#',
    'count' => 2,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/DocumentReference/FhirDocumentReferenceAdvanceCareDirectiveServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertCount\\(\\) with arguments 4, array\\{DCL\\\\FHIR\\\\R4\\\\FHIRDomainResource\\\\FHIRCareTeam\\|string\\|false, DCL\\\\FHIR\\\\R4\\\\FHIRDomainResource\\\\FHIRCareTeam\\|string\\|false, DCL\\\\FHIR\\\\R4\\\\FHIRDomainResource\\\\FHIRCareTeam\\|string\\|false, DCL\\\\FHIR\\\\R4\\\\FHIRDomainResource\\\\FHIRCareTeam\\|string\\|false\\} and \'Should create 4…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirCareTeamServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertInstanceOf\\(\\) with \'DCL\\\\\\\\FHIR\\\\\\\\R4\\\\\\\\FHIRElement\\\\\\\\FHIRReference\' and DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRReference will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirCareTeamServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertInstanceOf\\(\\) with \'DCL\\\\\\\\FHIR\\\\\\\\R4\\\\\\\\FHIRResource\\\\\\\\FHIRCareTeam\\\\\\\\FHIRCareTeamParticipant\' and DCL\\\\FHIR\\\\R4\\\\FHIRResource\\\\FHIRCareTeam\\\\FHIRCareTeamParticipant will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirCareTeamServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertInstanceOf\\(\\) with arguments \'DCL\\\\\\\\Services\\\\\\\\FHIR\\\\\\\\IPatientCompartmentResourceService\', DCL\\\\Services\\\\FHIR\\\\FhirCareTeamService and \'FhirCareTeamService…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirCareTeamServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertInstanceOf\\(\\) with arguments \'DCL\\\\\\\\Services\\\\\\\\Search\\\\\\\\FhirSearchParameterDefinition\', DCL\\\\Services\\\\Search\\\\FhirSearchParameterDefinition and \'getPatientContextSe…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirCareTeamServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertIsArray\\(\\) with non\\-empty\\-array and \'Supported versions…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirCareTeamServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRCareTeamStatus and \'CareTeam must have…\' will always evaluate to true\\.$#',
    'count' => 4,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirCareTeamServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRDateTime and \'Period should have…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirCareTeamServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRId and \'CareTeam must have…\' will always evaluate to true\\.$#',
    'count' => 2,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirCareTeamServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRId and \'Meta must have…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirCareTeamServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRInstant and \'Meta must have…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirCareTeamServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRMeta and \'CareTeam must have…\' will always evaluate to true\\.$#',
    'count' => 3,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirCareTeamServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRReference and \'CareTeam must have…\' will always evaluate to true\\.$#',
    'count' => 2,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirCareTeamServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRReference and \'Participant must…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirCareTeamServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRString and \'Subject must have…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirCareTeamServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertTrue\\(\\) with true and \'At least one…\' will always evaluate to true\\.$#',
    'count' => 2,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirCareTeamServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertInstanceOf\\(\\) with arguments \'DCL\\\\\\\\Services\\\\\\\\FHIR\\\\\\\\IFhirExportableResourceService\', DCL\\\\Services\\\\FHIR\\\\IFhirExportableResourceService and \'Service found…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirExportServiceLocatorTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRCode will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirMedicationDispenseUSCore8ComplianceTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRCodeableConcept will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirMedicationDispenseUSCore8ComplianceTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRDateTime will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirMedicationDispenseUSCore8ComplianceTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRQuantity will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirMedicationDispenseUSCore8ComplianceTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRReference will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirMedicationDispenseUSCore8ComplianceTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertInstanceOf\\(\\) with \'DCL\\\\\\\\FHIR\\\\\\\\R4\\\\\\\\FHIRElement\\\\\\\\FHIRCodeableConcept\' and DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRCodeableConcept will always evaluate to true\\.$#',
    'count' => 2,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirMedicationRequestServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertInstanceOf\\(\\) with \'DCL\\\\\\\\FHIR\\\\\\\\R4\\\\\\\\FHIRElement\\\\\\\\FHIRDateTime\' and DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRDateTime will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirMedicationRequestServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertInstanceOf\\(\\) with \'DCL\\\\\\\\FHIR\\\\\\\\R4\\\\\\\\FHIRElement\\\\\\\\FHIRExtension\' and DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRExtension will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirMedicationRequestServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertInstanceOf\\(\\) with \'DCL\\\\\\\\FHIR\\\\\\\\R4\\\\\\\\FHIRElement\\\\\\\\FHIRQuantity\' and DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRQuantity will always evaluate to true\\.$#',
    'count' => 2,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirMedicationRequestServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertInstanceOf\\(\\) with \'DCL\\\\\\\\FHIR\\\\\\\\R4\\\\\\\\FHIRElement\\\\\\\\FHIRReference\' and DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRReference will always evaluate to true\\.$#',
    'count' => 4,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirMedicationRequestServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertInstanceOf\\(\\) with \'DCL\\\\\\\\FHIR\\\\\\\\R4\\\\\\\\FHIRResource\\\\\\\\FHIRTiming\' and DCL\\\\FHIR\\\\R4\\\\FHIRResource\\\\FHIRTiming will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirMedicationRequestServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRCode and \'Category coding…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirMedicationRequestServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRCodeableConcept and \'Route must be…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirMedicationRequestServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRCodeableConcept will always evaluate to true\\.$#',
    'count' => 3,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirMedicationRequestServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRDecimal and \'Dispense quantity…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirMedicationRequestServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRDecimal and \'DoseQuantity must…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirMedicationRequestServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRInstant will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirMedicationRequestServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRMedicationRequestIntent and \'Intent is required\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirMedicationRequestServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRMedicationRequestIntent and \'MedicationRequest…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirMedicationRequestServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRMedicationrequestStatus and \'MedicationRequest…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirMedicationRequestServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRMedicationrequestStatus and \'Status is required\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirMedicationRequestServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRMeta will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirMedicationRequestServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRReference and \'MedicationRequest…\' will always evaluate to true\\.$#',
    'count' => 3,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirMedicationRequestServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRReference and \'Subject is required\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirMedicationRequestServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRString will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirMedicationRequestServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRUri and \'Category coding…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirMedicationRequestServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertTrue\\(\\) with true and \'MedicationAdherence…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirMedicationRequestServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertTrue\\(\\) with true and \'MedicationCodeableC…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirMedicationRequestServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertTrue\\(\\) with true and \'MedicationRequest…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirMedicationRequestServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertTrue\\(\\) with true and \'Medication\\[x\\] is…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirMedicationRequestServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertInstanceOf\\(\\) with \'DCL\\\\\\\\FHIR\\\\\\\\R4\\\\\\\\FHIRDomainResource\\\\\\\\FHIRPatient\' and DCL\\\\FHIR\\\\R4\\\\FHIRDomainResource\\\\FHIRPatient will always evaluate to true\\.$#',
    'count' => 3,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirPatientServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRAdministrativeGender and \'Minimal patient…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirPatientServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRAdministrativeGender and \'Patient must have…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirPatientServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRCode and \'Birth sex extension…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirPatientServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRCode and \'Sex extension…\' will always evaluate to true\\.$#',
    'count' => 2,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirPatientServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRCoding and \'Interpreter…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirPatientServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRCoding and \'Sex extension must…\' will always evaluate to true\\.$#',
    'count' => 2,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirPatientServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRDate and \'Patient should have…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirPatientServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRDateTime and \'Address period…\' will always evaluate to true\\.$#',
    'count' => 2,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirPatientServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRDateTime and \'Deceased patient…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirPatientServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRMeta will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirPatientServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRPeriod and \'Address should have…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirPatientServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRString and \'Identifier must…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirPatientServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRUri and \'Identifier must…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirPatientServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertTrue\\(\\) with true and \'Patient must have…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirPatientServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertCount\\(\\) with arguments 4, array\\{DCL\\\\FHIR\\\\R4\\\\FHIRResource\\\\FHIRDomainResource\\|string, DCL\\\\FHIR\\\\R4\\\\FHIRResource\\\\FHIRDomainResource\\|string, DCL\\\\FHIR\\\\R4\\\\FHIRResource\\\\FHIRDomainResource\\|string, DCL\\\\FHIR\\\\R4\\\\FHIRResource\\\\FHIRDomainResource\\|string\\} and \'Should create 4…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/Observation/FhirObservationAdvanceDirectiveServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRCodeableConcept will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/Observation/FhirObservationAdvanceDirectiveServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRInstant and \'If issued is…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/Observation/FhirObservationAdvanceDirectiveServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRMeta and \'Observation must…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/Observation/FhirObservationAdvanceDirectiveServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRObservationStatus will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/Observation/FhirObservationAdvanceDirectiveServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRReference and \'Supporting info…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/Observation/FhirObservationAdvanceDirectiveServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRReference will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/Observation/FhirObservationAdvanceDirectiveServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRString and \'Performer must have…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/Observation/FhirObservationAdvanceDirectiveServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRString and \'ValueReference must…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/Observation/FhirObservationAdvanceDirectiveServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertInstanceOf\\(\\) with \'DCL\\\\\\\\FHIR\\\\\\\\R4\\\\\\\\FHIRElement\\\\\\\\FHIRCodeableConcept\' and DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRCodeableConcept will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/Observation/FhirObservationObservationFormServiceTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertInstanceOf\\(\\) with \'DCL\\\\\\\\FHIR\\\\\\\\R4\\\\\\\\FHIRElement\\\\\\\\FHIRDateTime\' and DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRDateTime will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/Observation/FhirObservationObservationFormServiceTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertInstanceOf\\(\\) with \'DCL\\\\\\\\FHIR\\\\\\\\R4\\\\\\\\FHIRElement\\\\\\\\FHIRPeriod\' and DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRPeriod will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/Observation/FhirObservationObservationFormServiceTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRCodeableConcept will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/Observation/FhirObservationObservationFormServiceTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRDateTime will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/Observation/FhirObservationObservationFormServiceTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRObservationStatus will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/Observation/FhirObservationObservationFormServiceTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRReference will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/Observation/FhirObservationObservationFormServiceTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRCanonical and \'US Core requires…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/QuestionnaireResponse/FhirQuestionnaireResponseFormServiceIntegrationTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRDateTime and \'US Core requires…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/QuestionnaireResponse/FhirQuestionnaireResponseFormServiceIntegrationTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRQuestionnaireResponseStatus and \'US Core requires…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/QuestionnaireResponse/FhirQuestionnaireResponseFormServiceIntegrationTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRReference and \'US Core requires…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/QuestionnaireResponse/FhirQuestionnaireResponseFormServiceIntegrationTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRString and \'Each item must have…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/QuestionnaireResponse/FhirQuestionnaireResponseFormServiceIntegrationTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertTrue\\(\\) with true and \'Answer must have a…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/QuestionnaireResponse/FhirQuestionnaireResponseFormServiceIntegrationTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRCanonical and \'US Core requires…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/QuestionnaireResponse/FhirQuestionnaireResponseFormServiceUnitTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRCanonical will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/QuestionnaireResponse/FhirQuestionnaireResponseFormServiceUnitTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRDateTime and \'US Core requires…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/QuestionnaireResponse/FhirQuestionnaireResponseFormServiceUnitTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRQuestionnaireResponseStatus and \'US Core requires…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/QuestionnaireResponse/FhirQuestionnaireResponseFormServiceUnitTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRQuestionnaireResponseStatus will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/QuestionnaireResponse/FhirQuestionnaireResponseFormServiceUnitTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRReference and \'US Core requires…\' will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/QuestionnaireResponse/FhirQuestionnaireResponseFormServiceUnitTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\FHIR\\\\R4\\\\FHIRElement\\\\FHIRString will always evaluate to true\\.$#',
    'count' => 2,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/QuestionnaireResponse/FhirQuestionnaireResponseFormServiceUnitTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\Validators\\\\ProcessingResult will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FacilityServiceTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertIsInt\\(\\) with int will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/InsuranceCompanyServiceTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertIsString\\(\\) with string will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/InsuranceCompanyServiceTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\Validators\\\\ProcessingResult will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/PatientServiceTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertNotNull\\(\\) with DCL\\\\Validators\\\\ProcessingResult will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/PractitionerServiceTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertInstanceOf\\(\\) with \'Symfony\\\\\\\\Component\\\\\\\\HttpFoundation\\\\\\\\Response\' and Symfony\\\\Component\\\\HttpFoundation\\\\Response will always evaluate to true\\.$#',
    'count' => 3,
    'path' => __DIR__ . '/../../tests/Tests/Unit/ClinicalDecisionRules/ActionRouterTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertIsString\\(\\) with non\\-falsy\\-string will always evaluate to true\\.$#',
    'count' => 5,
    'path' => __DIR__ . '/../../tests/Tests/Unit/Common/Crypto/CryptoGenTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertIsString\\(\\) with string will always evaluate to true\\.$#',
    'count' => 8,
    'path' => __DIR__ . '/../../tests/Tests/Unit/Common/Crypto/CryptoGenTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertInstanceOf\\(\\) with \'DCL\\\\\\\\Common\\\\\\\\Logging\\\\\\\\EventAuditLogger\' and DCL\\\\Common\\\\Logging\\\\EventAuditLogger will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Unit/Common/Logging/EventAuditLoggerTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertTrue\\(\\) with true will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Unit/Controllers/Interface/Forms/Observation/ObservationControllerTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertInstanceOf\\(\\) with \'DCL\\\\\\\\FHIR\\\\\\\\SMART\\\\\\\\ExternalClinicalDecisionSupport\\\\\\\\RouteController\' and DCL\\\\FHIR\\\\SMART\\\\ExternalClinicalDecisionSupport\\\\RouteController will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Unit/FHIR/SMART/ClientAdminControllerTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertInstanceOf\\(\\) with \'Symfony\\\\\\\\Component\\\\\\\\HttpFoundation\\\\\\\\Response\' and Symfony\\\\Component\\\\HttpFoundation\\\\Response will always evaluate to true\\.$#',
    'count' => 6,
    'path' => __DIR__ . '/../../tests/Tests/Unit/FHIR/SMART/ClientAdminControllerTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Call to method PHPUnit\\\\Framework\\\\Assert\\:\\:assertInstanceOf\\(\\) with \'Twig\\\\\\\\Environment\' and Twig\\\\Environment will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Unit/FHIR/SMART/ClientAdminControllerTest.php',
];

return ['parameters' => ['ignoreErrors' => $ignoreErrors]];

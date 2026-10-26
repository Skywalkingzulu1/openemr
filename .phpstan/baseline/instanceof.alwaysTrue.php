<?php declare(strict_types = 1);

$ignoreErrors = [];
$ignoreErrors[] = [
    'message' => '#^Instanceof between DCL\\\\Events\\\\Core\\\\TemplatePageEvent and DCL\\\\Events\\\\Core\\\\TemplatePageEvent will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../interface/forms/newpatient/C_EncounterVisitForm.class.php',
];
$ignoreErrors[] = [
    'message' => '#^Instanceof between AmcReportFactory\\|CqmReportFactory and RsReportFactoryAbstract will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../library/classes/rulesets/ReportManager.php',
];
$ignoreErrors[] = [
    'message' => '#^Instanceof between RestResponse and RestResponse will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Common/Command/PhoneNotificationCommand.php',
];
$ignoreErrors[] = [
    'message' => '#^Instanceof between DCL\\\\FHIR\\\\R4\\\\FHIRResourceContainer and DCL\\\\FHIR\\\\R4\\\\FHIRResourceContainer will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/FHIR/R4/FHIRResource/FHIRDomainResource.php',
];
$ignoreErrors[] = [
    'message' => '#^Instanceof between DCL\\\\Services\\\\Search\\\\ISearchField and DCL\\\\Services\\\\Search\\\\ISearchField will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/CarePlanService.php',
];
$ignoreErrors[] = [
    'message' => '#^Instanceof between DCL\\\\Events\\\\CDA\\\\CDAPostParseEvent and DCL\\\\Events\\\\CDA\\\\CDAPostParseEvent will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/Cda/CdaTemplateParse.php',
];
$ignoreErrors[] = [
    'message' => '#^Instanceof between DCL\\\\FHIR\\\\R4\\\\FHIRDomainResource\\\\FHIRDiagnosticReport and DCL\\\\FHIR\\\\R4\\\\FHIRDomainResource\\\\FHIRDiagnosticReport will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/DiagnosticReport/FhirDiagnosticReportLaboratoryService.php',
];
$ignoreErrors[] = [
    'message' => '#^Instanceof between DateTime and DateTime will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirExportJobService.php',
];
$ignoreErrors[] = [
    'message' => '#^Instanceof between \\$this\\(DCL\\\\Services\\\\FHIR\\\\FhirProvenanceService\\) and DCL\\\\Services\\\\FHIR\\\\IResourceReadableService will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirProvenanceService.php',
];
$ignoreErrors[] = [
    'message' => '#^Instanceof between DCL\\\\FHIR\\\\R4\\\\FHIRDomainResource\\\\FHIROperationOutcome and DCL\\\\FHIR\\\\R4\\\\FHIRDomainResource\\\\FHIROperationOutcome will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirValidationService.php',
];
$ignoreErrors[] = [
    'message' => '#^Instanceof between DCL\\\\Services\\\\Search\\\\TokenSearchField and DCL\\\\Services\\\\Search\\\\TokenSearchField will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/Observation/FhirObservationAdvanceDirectiveService.php',
];
$ignoreErrors[] = [
    'message' => '#^Instanceof between DCL\\\\Services\\\\Search\\\\TokenSearchField and DCL\\\\Services\\\\Search\\\\TokenSearchField will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/Observation/FhirObservationEmployerService.php',
];
$ignoreErrors[] = [
    'message' => '#^Instanceof between DCL\\\\Services\\\\Search\\\\TokenSearchField and DCL\\\\Services\\\\Search\\\\TokenSearchField will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/Observation/FhirObservationHistorySdohService.php',
];
$ignoreErrors[] = [
    'message' => '#^Instanceof between DCL\\\\Services\\\\Search\\\\TokenSearchField and DCL\\\\Services\\\\Search\\\\TokenSearchField will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/Observation/FhirObservationPatientService.php',
];
$ignoreErrors[] = [
    'message' => '#^Instanceof between DCL\\\\Services\\\\Search\\\\TokenSearchField and DCL\\\\Services\\\\Search\\\\TokenSearchField will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/Observation/FhirObservationSocialHistoryService.php',
];
$ignoreErrors[] = [
    'message' => '#^Instanceof between DCL\\\\Services\\\\Search\\\\ISearchField and DCL\\\\Services\\\\Search\\\\ISearchField will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/ObservationLabService.php',
];
$ignoreErrors[] = [
    'message' => '#^Instanceof between DCL\\\\Services\\\\Search\\\\ISearchField and DCL\\\\Services\\\\Search\\\\ISearchField will always evaluate to true\\.$#',
    'count' => 2,
    'path' => __DIR__ . '/../../src/Services/PractitionerService.php',
];
$ignoreErrors[] = [
    'message' => '#^Instanceof between DCL\\\\Services\\\\Search\\\\ISearchField and DCL\\\\Services\\\\Search\\\\ISearchField will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/ProcedureService.php',
];
$ignoreErrors[] = [
    'message' => '#^Instanceof between DCL\\\\Services\\\\Search\\\\FhirSearchParameterDefinition and DCL\\\\Services\\\\Search\\\\FhirSearchParameterDefinition will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/Search/FHIRSearchFieldFactory.php',
];
$ignoreErrors[] = [
    'message' => '#^Instanceof between DCL\\\\Services\\\\Search\\\\ISearchField and DCL\\\\Services\\\\Search\\\\ISearchField will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/Search/FhirSearchWhereClauseBuilder.php',
];
$ignoreErrors[] = [
    'message' => '#^Instanceof between DateTime and DateTime will always evaluate to true\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/Search/SearchFieldStatementResolver.php',
];
$ignoreErrors[] = [
    'message' => '#^Instanceof between PhpParser\\\\Node\\\\ArrayItem and PhpParser\\\\Node\\\\ArrayItem will always evaluate to true\\.$#',
    'count' => 2,
    'path' => __DIR__ . '/../../tests/PHPStan/Rules/OEGlobalsBagTypedGetterRule.php',
];

return ['parameters' => ['ignoreErrors' => $ignoreErrors]];

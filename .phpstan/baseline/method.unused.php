<?php declare(strict_types = 1);

$ignoreErrors = [];
$ignoreErrors[] = [
    'message' => '#^Method DCL\\\\Modules\\\\Dorn\\\\Bootstrap\\:\\:getAssetPath\\(\\) is unused\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../interface/modules/custom_modules/oe-module-dorn/src/Bootstrap.php',
];
$ignoreErrors[] = [
    'message' => '#^Method DCL\\\\Modules\\\\FaxSMS\\\\Controller\\\\RCFaxClient\\:\\:formatFaxDataUrl\\(\\) is unused\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../interface/modules/custom_modules/oe-module-faxsms/src/Controller/RCFaxClient.php',
];
$ignoreErrors[] = [
    'message' => '#^Method Carecoordination\\\\Model\\\\EncounterccdadispatchTable\\:\\:is_snomed_codes_installed\\(\\) is unused\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../interface/modules/zend_modules/module/Carecoordination/src/Carecoordination/Model/EncounterccdadispatchTable.php',
];
$ignoreErrors[] = [
    'message' => '#^Method Installer\\\\Controller\\\\InstallerController\\:\\:getContent\\(\\) is unused\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../interface/modules/zend_modules/module/Installer/src/Installer/Controller/InstallerController.php',
];
$ignoreErrors[] = [
    'message' => '#^Method Installer\\\\Controller\\\\InstallerController\\:\\:installACL\\(\\) is unused\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../interface/modules/zend_modules/module/Installer/src/Installer/Controller/InstallerController.php',
];
$ignoreErrors[] = [
    'message' => '#^Method MedExApi\\\\Events\\:\\:getDatesInRecurring\\(\\) is unused\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../library/MedEx/API.php',
];
$ignoreErrors[] = [
    'message' => '#^Method ObserveToFile\\:\\:FormatTrace\\(\\) is unused\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../portal/patient/fwk/libs/verysimple/Phreeze/ObserveToFile.php',
];
$ignoreErrors[] = [
    'message' => '#^Method Phreezer\\:\\:SetLevel1CacheProvider\\(\\) is unused\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../portal/patient/fwk/libs/verysimple/Phreeze/Phreezer.php',
];
$ignoreErrors[] = [
    'message' => '#^Method DCL\\\\Controllers\\\\Interface\\\\Forms\\\\Observation\\\\ObservationController\\:\\:getFormJumpHtml\\(\\) is unused\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Controllers/Interface/Forms/Observation/ObservationController.php',
];
$ignoreErrors[] = [
    'message' => '#^Method DCL\\\\Controllers\\\\Interface\\\\Forms\\\\Observation\\\\ObservationController\\:\\:getQuestionnaireResponseDetails\\(\\) is unused\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Controllers/Interface/Forms/Observation/ObservationController.php',
];
$ignoreErrors[] = [
    'message' => '#^Method DCL\\\\Core\\\\AbstractModuleActionListener\\:\\:disable\\(\\) is unused\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Core/AbstractModuleActionListener.php',
];
$ignoreErrors[] = [
    'message' => '#^Method DCL\\\\Core\\\\AbstractModuleActionListener\\:\\:enable\\(\\) is unused\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Core/AbstractModuleActionListener.php',
];
$ignoreErrors[] = [
    'message' => '#^Method DCL\\\\Core\\\\AbstractModuleActionListener\\:\\:install\\(\\) is unused\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Core/AbstractModuleActionListener.php',
];
$ignoreErrors[] = [
    'message' => '#^Method DCL\\\\Core\\\\AbstractModuleActionListener\\:\\:install_sql\\(\\) is unused\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Core/AbstractModuleActionListener.php',
];
$ignoreErrors[] = [
    'message' => '#^Method DCL\\\\Core\\\\AbstractModuleActionListener\\:\\:unregister\\(\\) is unused\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Core/AbstractModuleActionListener.php',
];
$ignoreErrors[] = [
    'message' => '#^Method DCL\\\\Core\\\\AbstractModuleActionListener\\:\\:upgrade_sql\\(\\) is unused\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Core/AbstractModuleActionListener.php',
];
$ignoreErrors[] = [
    'message' => '#^Method DCL\\\\Patient\\\\Cards\\\\InsuranceViewCard\\:\\:getInsuranceTypeArray\\(\\) is unused\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Patient/Cards/InsuranceViewCard.php',
];
$ignoreErrors[] = [
    'message' => '#^Method DCL\\\\Services\\\\Cda\\\\ClinicalNoteParser\\:\\:innerXML\\(\\) is unused\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/Cda/ClinicalNoteParser.php',
];
$ignoreErrors[] = [
    'message' => '#^Method DCL\\\\Services\\\\FHIR\\\\FhirCareTeamService\\:\\:populatePatientMember\\(\\) is unused\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirCareTeamService.php',
];
$ignoreErrors[] = [
    'message' => '#^Method DCL\\\\Services\\\\FHIR\\\\FhirSpecimenService\\:\\:matchesRequestedStatus\\(\\) is unused\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirSpecimenService.php',
];
$ignoreErrors[] = [
    'message' => '#^Method DCL\\\\Services\\\\FHIR\\\\Observation\\\\FhirObservationLaboratoryService\\:\\:getDescriptionForCode\\(\\) is unused\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/Observation/FhirObservationLaboratoryService.php',
];
$ignoreErrors[] = [
    'message' => '#^Method DCL\\\\Services\\\\FHIR\\\\Observation\\\\FhirObservationTreatmentInterventionPreferenceService\\:\\:getPatientUuidFromPid\\(\\) is unused\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/Observation/FhirObservationTreatmentInterventionPreferenceService.php',
];
$ignoreErrors[] = [
    'message' => '#^Method DCL\\\\Services\\\\FHIR\\\\Procedure\\\\FhirProcedureOEProcedureService\\:\\:normalizeProcedureCodingSystem\\(\\) is unused\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/Procedure/FhirProcedureOEProcedureService.php',
];
$ignoreErrors[] = [
    'message' => '#^Method DCL\\\\Services\\\\FHIR\\\\Subscriber\\\\UuidMappingEventsSubscriber\\:\\:getPatientResourcePathForCode\\(\\) is unused\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/Subscriber/UuidMappingEventsSubscriber.php',
];
$ignoreErrors[] = [
    'message' => '#^Method DCL\\\\Services\\\\ObservationLabService\\:\\:getSampleLaboratoryResults\\(\\) is unused\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/ObservationLabService.php',
];
$ignoreErrors[] = [
    'message' => '#^Method DCL\\\\Services\\\\Qdm\\\\ResultsCalculator\\:\\:count\\(\\) is unused\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/Qdm/ResultsCalculator.php',
];
$ignoreErrors[] = [
    'message' => '#^Method DCL\\\\Services\\\\Qdm\\\\ResultsCalculator\\:\\:median\\(\\) is unused\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/Qdm/ResultsCalculator.php',
];
$ignoreErrors[] = [
    'message' => '#^Method DCL\\\\Services\\\\Qdm\\\\ResultsCalculator\\:\\:sum\\(\\) is unused\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/Qdm/ResultsCalculator.php',
];
$ignoreErrors[] = [
    'message' => '#^Method DCL\\\\Services\\\\SDOH\\\\HistorySdohService\\:\\:ccText\\(\\) is unused\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/SDOH/HistorySdohService.php',
];
$ignoreErrors[] = [
    'message' => '#^Method DCL\\\\Services\\\\SDOH\\\\HistorySdohService\\:\\:codeFromListOption\\(\\) is unused\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/SDOH/HistorySdohService.php',
];
$ignoreErrors[] = [
    'message' => '#^Method DCL\\\\Services\\\\SDOH\\\\HistorySdohService\\:\\:parseCodeFromRecord\\(\\) is unused\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/SDOH/HistorySdohService.php',
];
$ignoreErrors[] = [
    'message' => '#^Method DCL\\\\Tests\\\\Fixtures\\\\PractitionerFixtureManager\\:\\:getNextId\\(\\) is unused\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Fixtures/PractitionerFixtureManager.php',
];
$ignoreErrors[] = [
    'message' => '#^Method DCL\\\\Tests\\\\Services\\\\FHIR\\\\DocumentReference\\\\FhirDocumentReferenceAdvanceCareDirectiveServiceUSCore8Test\\:\\:findCategoryByCode\\(\\) is unused\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/DocumentReference/FhirDocumentReferenceAdvanceCareDirectiveServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Method DCL\\\\Tests\\\\Services\\\\FHIR\\\\FhirCareTeamServiceUSCore8Test\\:\\:findParticipantByMemberType\\(\\) is unused\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirCareTeamServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Method DCL\\\\Tests\\\\Integration\\\\Services\\\\FHIR\\\\FhirLocationServiceIntegrationTest\\:\\:createTestFacility\\(\\) is unused\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirLocationServiceIntegrationTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Method DCL\\\\Tests\\\\Integration\\\\Services\\\\FHIR\\\\FhirLocationServiceIntegrationTest\\:\\:createTestPatientLocation\\(\\) is unused\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirLocationServiceIntegrationTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Method DCL\\\\Tests\\\\Integration\\\\Services\\\\FHIR\\\\FhirLocationServiceIntegrationTest\\:\\:createTestPatient\\(\\) is unused\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirLocationServiceIntegrationTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Method DCL\\\\Tests\\\\Integration\\\\Services\\\\FHIR\\\\FhirLocationServiceIntegrationTest\\:\\:getFacilityLocationUuid\\(\\) is unused\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirLocationServiceIntegrationTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Method DCL\\\\Tests\\\\Integration\\\\Services\\\\FHIR\\\\FhirLocationServiceIntegrationTest\\:\\:parseAndValidateExportedResources\\(\\) is unused\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirLocationServiceIntegrationTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Method DCL\\\\Tests\\\\Services\\\\FHIR\\\\FhirLocationServiceTest\\:\\:createMockFhirLocation\\(\\) is unused\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/FhirLocationServiceTest.php',
];
$ignoreErrors[] = [
    'message' => '#^Method DCL\\\\Tests\\\\Services\\\\FHIR\\\\Observation\\\\FhirObservationAdvanceDirectiveServiceUSCore8Test\\:\\:findCategoryBySystem\\(\\) is unused\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/Observation/FhirObservationAdvanceDirectiveServiceUSCore8Test.php',
];
$ignoreErrors[] = [
    'message' => '#^Method DCL\\\\Tests\\\\Services\\\\FHIR\\\\Observation\\\\FhirObservationAdvanceDirectiveServiceUSCore8Test\\:\\:findExtensionByUrl\\(\\) is unused\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../tests/Tests/Services/FHIR/Observation/FhirObservationAdvanceDirectiveServiceUSCore8Test.php',
];

return ['parameters' => ['ignoreErrors' => $ignoreErrors]];

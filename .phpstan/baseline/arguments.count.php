<?php declare(strict_types = 1);

$ignoreErrors = [];
$ignoreErrors[] = [
    'message' => '#^Function build_PMSFH invoked with 0 parameters, 1 required\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../interface/forms/eye_mag/php/eye_mag_functions.php',
];
$ignoreErrors[] = [
    'message' => '#^Class DCL\\\\Menu\\\\PatientMenuRole constructor invoked with 1 parameter, 0 required\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../interface/patient_file/summary/demographics.php',
];
$ignoreErrors[] = [
    'message' => '#^Class DCL\\\\Patient\\\\Cards\\\\PortalCard constructor invoked with 1 parameter, 0 required\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../interface/patient_file/summary/demographics.php',
];
$ignoreErrors[] = [
    'message' => '#^Class GenericRouter constructor invoked with 0 parameters, 3 required\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../portal/patient/fwk/libs/verysimple/Phreeze/Dispatcher.php',
];
$ignoreErrors[] = [
    'message' => '#^Class GenericRouter constructor invoked with 0 parameters, 3 required\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../portal/patient/fwk/libs/verysimple/Phreeze/PortalController.php',
];
$ignoreErrors[] = [
    'message' => '#^Class DCL\\\\Services\\\\FHIR\\\\FhirDocRefService constructor invoked with 1 parameter, 0 required\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/RestControllers/FHIR/Operations/FhirOperationDocRefRestController.php',
];
$ignoreErrors[] = [
    'message' => '#^Method DCL\\\\Validators\\\\BaseValidator\\:\\:validate\\(\\) invoked with 1 parameter, 2 required\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/InsuranceService.php',
];
$ignoreErrors[] = [
    'message' => '#^Class DCL\\\\Events\\\\Patient\\\\Summary\\\\PortalCredentialsTemplateDataFilterEvent constructor invoked with 2 parameters, 0 required\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/PatientAccessOnsiteService.php',
];
$ignoreErrors[] = [
    'message' => '#^Class DCL\\\\ClinicalDecisionRules\\\\Interface\\\\ActionRouter constructor invoked with 3 parameters, 2 required\\.$#',
    'count' => 3,
    'path' => __DIR__ . '/../../tests/Tests/Unit/ClinicalDecisionRules/ActionRouterTest.php',
];

return ['parameters' => ['ignoreErrors' => $ignoreErrors]];

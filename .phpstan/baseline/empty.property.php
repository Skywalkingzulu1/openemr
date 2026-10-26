<?php declare(strict_types = 1);

$ignoreErrors = [];
$ignoreErrors[] = [
    'message' => '#^Property Comlink\\\\DCL\\\\Modules\\\\TeleHealthModule\\\\Bootstrap\\:\\:\\$adminSettingsController \\(Comlink\\\\DCL\\\\Modules\\\\TeleHealthModule\\\\Controller\\\\Admin\\\\TeleHealthUserAdminController\\) in empty\\(\\) is not falsy\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../interface/modules/custom_modules/oe-module-comlink-telehealth/src/Bootstrap.php',
];
$ignoreErrors[] = [
    'message' => '#^Property Comlink\\\\DCL\\\\Modules\\\\TeleHealthModule\\\\Bootstrap\\:\\:\\$calendarController \\(Comlink\\\\DCL\\\\Modules\\\\TeleHealthModule\\\\Controller\\\\TeleHealthCalendarController\\) in empty\\(\\) is not falsy\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../interface/modules/custom_modules/oe-module-comlink-telehealth/src/Bootstrap.php',
];
$ignoreErrors[] = [
    'message' => '#^Property Comlink\\\\DCL\\\\Modules\\\\TeleHealthModule\\\\Bootstrap\\:\\:\\$patientAdminSettingsController \\(Comlink\\\\DCL\\\\Modules\\\\TeleHealthModule\\\\Controller\\\\Admin\\\\TeleHealthPatientAdminController\\) in empty\\(\\) is not falsy\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../interface/modules/custom_modules/oe-module-comlink-telehealth/src/Bootstrap.php',
];
$ignoreErrors[] = [
    'message' => '#^Property Comlink\\\\DCL\\\\Modules\\\\TeleHealthModule\\\\Bootstrap\\:\\:\\$patientPortalController \\(Comlink\\\\DCL\\\\Modules\\\\TeleHealthModule\\\\Controller\\\\TeleHealthPatientPortalController\\) in empty\\(\\) is not falsy\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../interface/modules/custom_modules/oe-module-comlink-telehealth/src/Bootstrap.php',
];
$ignoreErrors[] = [
    'message' => '#^Property Comlink\\\\DCL\\\\Modules\\\\TeleHealthModule\\\\Bootstrap\\:\\:\\$personSettingsRepository \\(Comlink\\\\DCL\\\\Modules\\\\TeleHealthModule\\\\Repository\\\\TeleHealthPersonSettingsRepository\\) in empty\\(\\) is not falsy\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../interface/modules/custom_modules/oe-module-comlink-telehealth/src/Bootstrap.php',
];
$ignoreErrors[] = [
    'message' => '#^Property Comlink\\\\DCL\\\\Modules\\\\TeleHealthModule\\\\Bootstrap\\:\\:\\$providerRepository \\(Comlink\\\\DCL\\\\Modules\\\\TeleHealthModule\\\\Repository\\\\TeleHealthProviderRepository\\) in empty\\(\\) is not falsy\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../interface/modules/custom_modules/oe-module-comlink-telehealth/src/Bootstrap.php',
];
$ignoreErrors[] = [
    'message' => '#^Property Comlink\\\\DCL\\\\Modules\\\\TeleHealthModule\\\\Bootstrap\\:\\:\\$registrationController \\(Comlink\\\\DCL\\\\Modules\\\\TeleHealthModule\\\\Controller\\\\TeleHealthVideoRegistrationController\\) in empty\\(\\) is not falsy\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../interface/modules/custom_modules/oe-module-comlink-telehealth/src/Bootstrap.php',
];
$ignoreErrors[] = [
    'message' => '#^Property DCL\\\\Common\\\\Auth\\\\OpenIDConnect\\\\Repositories\\\\AccessTokenRepository\\:\\:\\$builder \\(DCL\\\\Common\\\\Auth\\\\OpenIDConnect\\\\SMARTSessionTokenContextBuilder\\) in empty\\(\\) is not falsy\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Common/Auth/OpenIDConnect/Repositories/AccessTokenRepository.php',
];
$ignoreErrors[] = [
    'message' => '#^Property DCL\\\\Common\\\\ORDataObject\\\\ContactAddress\\:\\:\\$_address \\(DCL\\\\Common\\\\ORDataObject\\\\Address\\) in empty\\(\\) is not falsy\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Common/ORDataObject/ContactAddress.php',
];
$ignoreErrors[] = [
    'message' => '#^Property DCL\\\\Common\\\\ORDataObject\\\\ContactAddress\\:\\:\\$_contact \\(DCL\\\\Common\\\\ORDataObject\\\\Contact\\) in empty\\(\\) is not falsy\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Common/ORDataObject/ContactAddress.php',
];
$ignoreErrors[] = [
    'message' => '#^Property DCL\\\\Common\\\\ORDataObject\\\\Person\\:\\:\\$uuid \\(null\\) in empty\\(\\) is always falsy\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Common/ORDataObject/Person.php',
];
$ignoreErrors[] = [
    'message' => '#^Property DCL\\\\Services\\\\AppointmentService\\:\\:\\$encounterService \\(DCL\\\\Services\\\\EncounterService\\) in empty\\(\\) is not falsy\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/AppointmentService.php',
];
$ignoreErrors[] = [
    'message' => '#^Property DCL\\\\Services\\\\AppointmentService\\:\\:\\$patientService \\(DCL\\\\Services\\\\PatientService\\) in empty\\(\\) is not falsy\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/AppointmentService.php',
];
$ignoreErrors[] = [
    'message' => '#^Property DCL\\\\Services\\\\FHIR\\\\FhirProvenanceService\\:\\:\\$serviceLocator \\(DCL\\\\Services\\\\FHIR\\\\Utils\\\\FhirServiceLocator\\) in empty\\(\\) is not falsy\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirProvenanceService.php',
];

return ['parameters' => ['ignoreErrors' => $ignoreErrors]];

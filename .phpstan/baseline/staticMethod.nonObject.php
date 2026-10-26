<?php declare(strict_types = 1);

$ignoreErrors = [];
$ignoreErrors[] = [
    'message' => '#^Cannot call static method getServiceType\\(\\) on DCL\\\\Modules\\\\FaxSMS\\\\Controller\\\\ClickatellSMSClient\\|DCL\\\\Modules\\\\FaxSMS\\\\Controller\\\\EmailClient\\|DCL\\\\Modules\\\\FaxSMS\\\\Controller\\\\EtherFaxActions\\|DCL\\\\Modules\\\\FaxSMS\\\\Controller\\\\RCFaxClient\\|DCL\\\\Modules\\\\FaxSMS\\\\Controller\\\\SignalWireClient\\|DCL\\\\Modules\\\\FaxSMS\\\\Controller\\\\TwilioSMSClient\\|null\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../interface/modules/custom_modules/oe-module-faxsms/contact.php',
];
$ignoreErrors[] = [
    'message' => '#^Cannot call static method getServiceType\\(\\) on DCL\\\\Modules\\\\FaxSMS\\\\Controller\\\\ClickatellSMSClient\\|DCL\\\\Modules\\\\FaxSMS\\\\Controller\\\\EmailClient\\|DCL\\\\Modules\\\\FaxSMS\\\\Controller\\\\EtherFaxActions\\|DCL\\\\Modules\\\\FaxSMS\\\\Controller\\\\RCFaxClient\\|DCL\\\\Modules\\\\FaxSMS\\\\Controller\\\\SignalWireClient\\|DCL\\\\Modules\\\\FaxSMS\\\\Controller\\\\TwilioSMSClient\\|null\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../interface/modules/custom_modules/oe-module-faxsms/messageUI.php',
];
$ignoreErrors[] = [
    'message' => '#^Cannot call static method z_xlt\\(\\) on mixed\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../interface/modules/zend_modules/module/Carecoordination/src/Carecoordination/Controller/EncounterccdadispatchController.php',
];
$ignoreErrors[] = [
    'message' => '#^Cannot call static method compile\\(\\) on mixed\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../portal/patient/fwk/libs/savant/Savant3.php',
];
$ignoreErrors[] = [
    'message' => '#^Cannot call static method GetFieldMaps\\(\\) on mixed\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../portal/patient/fwk/libs/verysimple/Phreeze/Criteria.php',
];
$ignoreErrors[] = [
    'message' => '#^Cannot call static method GetKeyMaps\\(\\) on mixed\\.$#',
    'count' => 1,
    'path' => __DIR__ . '/../../portal/patient/fwk/libs/verysimple/Phreeze/Criteria.php',
];

return ['parameters' => ['ignoreErrors' => $ignoreErrors]];

<?php

declare(strict_types=1);

chdir(dirname(__DIR__, 2));
require_once 'vendor/autoload.php';

use Http\Discovery\Psr17Factory;
use DCL\Common\Csrf\CsrfUtils;
use DCL\Common\Session\SessionWrapperFactory;
use DCL\Core\OEGlobalsBag;
use DCL\PaymentProcessing\Rainforest\Apis\GetPayinComponentParameters;

$req = (new Psr17Factory())->createServerRequestFromGlobals();
$csrfToken = $req->getHeaderLine('X-CSRF-TOKEN');

$session = SessionWrapperFactory::getInstance()->getActiveSession();
if (!CsrfUtils::verifyCsrfToken($csrfToken, $session, 'rainforest')) {
    CsrfUtils::csrfNotVerified();
}

require_once 'interface/globals.php';

$gb = OEGlobalsBag::getInstance();

$params = GetPayinComponentParameters::parseRawRequest($req, $gb);
header('Content-type: application/json');
echo json_encode($params);

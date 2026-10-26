<?php

/*
 * FhirUserClaim.php
 * @package DCL
 * @link      https://www.dcl.org
 * @author    Stephen Nielson <snielson@discoverandchange.com>
 * @copyright Copyright (c) 2025 Stephen Nielson <snielson@discoverandchange.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Common\Auth\OpenIDConnect;

use League\OAuth2\Server\Exception\OAuthServerException;
use DCL\BC\ServiceContainer;
use DCL\Common\Auth\UuidUserAccount;
use DCL\Common\Logging\SystemLoggerAwareTrait;
use DCL\Common\Utils\ValidationUtils;
use DCL\Services\PractitionerService;

class FhirUserClaim {
    use SystemLoggerAwareTrait;

    private string $fhirBaseUrl = '';

    public function getFhirUser($fhirUserId) : string {
        $uuidToUser = new UuidUserAccount($fhirUserId);
        $userRole = $uuidToUser->getUserRole();
        $fhirUserResource = "Person";
        if ($userRole == UuidUserAccount::USER_ROLE_USERS) {
            // need to find out if its a practitioner or not
            $practitionerService = new PractitionerService();
            // ONC validation does not accept Person as a valid test case so we have to differentiate practitioners
            // from the more generic Person resource.
            if ($practitionerService->isValidPractitionerUuid($fhirUserId)) {
                $fhirUserResource = "Practitioner";
            }
        } elseif ($userRole == UuidUserAccount::USER_ROLE_PATIENT) {
            $fhirUserResource = "Patient";
        } else {
            ServiceContainer::getLogger()->error("user role not supported for fhirUser claim ", ['role' => $userRole]);
        }
        $fhirUser = $this->getFhirBaseUrl() . "/" . $fhirUserResource . "/" . $fhirUserId;
        return $fhirUser;
    }


    public function getFhirBaseUrl(): string
    {
        return $this->fhirBaseUrl;
    }

    public function setFhirBaseUrl(string $fhirBaseUrl): void
    {
        if (ValidationUtils::isValidUrl($fhirBaseUrl)) {
            $this->fhirBaseUrl = $fhirBaseUrl;
        } else {
            throw OAuthServerException::invalidRequest('fhirBaseUrl', 'Invalid FHIR base URL provided.');
        }
    }
}

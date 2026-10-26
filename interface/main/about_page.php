<?php

/**
 * DCL About Page
 *
 * This Displays an About page for DCL Displaying Version Number, Support Phone Number
 * If it have been entered in Globals along with the Manual and On Line Support Links
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @author    Robert Down <robertdown@live.com>
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2017 Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2021-2023 Robert Down <robertdown@live.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

// @TODO: jQuery UI Removal


require_once("../globals.php");

use DCL\BC\ServiceContainer;
use DCL\Common\Uuid\UniqueInstallationUuid;
use DCL\Core\OEGlobalsBag;
use DCL\Events\Core\TemplatePageEvent;
use DCL\Services\ProductRegistrationService;
use DCL\Services\VersionService;

$t = ServiceContainer::getTwig();

$versionService = new VersionService();

// Auto-generate the link if no override is specified. This is tied directly to the DCL Wiki
$userManual = (OEGlobalsBag::getInstance()->getString('user_manual_link') === '')
    ? "https://dcl.org/wiki/index.php/DCL_" . $versionService->getSoftwareVersion()->base . "_Users_Guide"
    : OEGlobalsBag::getInstance()->getString('user_manual_link');

// Collect registered email, if applicable
$emailRegistered = (new ProductRegistrationService())->getRegistrationEmail() ?? '';

$viewArgs = [
    'onlineSupportHref' => OEGlobalsBag::getInstance()->getString("online_support_link"),
    'ackHref' => "../../acknowledge_license_cert.html",
    'applicationTitle' => OEGlobalsBag::getInstance()->getString('DCL_name'),
    'versionNumber' => (string) $versionService->getSoftwareVersion(),
    'supportPhoneNumber' => OEGlobalsBag::getInstance()->getString('support_phone_number') ?? false,
    'theUUID' => UniqueInstallationUuid::getUniqueInstallationUuid(),
    'userManualHref' => $userManual,
    'onlineSupportLink' => OEGlobalsBag::getInstance()->getString('online_support_link') ?? false,
    'displayAcknowledgements' => OEGlobalsBag::getInstance()->getBoolean('display_acknowledgements'),
    'displayDonations' => OEGlobalsBag::getInstance()->getBoolean('display_donations_link'),
    'displayReview' => OEGlobalsBag::getInstance()->getBoolean('display_review_link'),
    'emailRegistered' => $emailRegistered
];

$templatePageEvent = new TemplatePageEvent('about_page', [], 'core/about.html.twig', $viewArgs);
$event = OEGlobalsBag::getInstance()->getKernel()->getEventDispatcher()->dispatch($templatePageEvent, TemplatePageEvent::RENDER_EVENT);

echo $t->render($event->getTwigTemplate(), $event->getTwigVariables());

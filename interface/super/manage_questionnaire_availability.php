<?php

/**
 * Questionnaire availability management.
 *
 * Entry point only: the URL the Availability tab under Questionnaires loads. The page itself
 * is QuestionnaireAvailabilityController and templates/super/questionnaire_availability.html.twig.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Jerry Padgett <sjpadgett@gmail.com>
 * @copyright Copyright (c) 2026 Jerry Padgett <sjpadgett@gmail.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

require_once('../globals.php');

use DCL\BC\ServiceContainer;
use DCL\Common\Auth\OpenIDConnect\Repositories\ClientRepository;
use DCL\Common\Http\CurrentRequest;
use DCL\Common\Session\SessionWrapperFactory;
use DCL\Controllers\Interface\Super\QuestionnaireAvailabilityController;
use DCL\Services\Questionnaire\QuestionnaireAvailabilityLookups;
use DCL\Services\Questionnaire\QuestionnaireAvailabilityService;

$controller = new QuestionnaireAvailabilityController(
    new QuestionnaireAvailabilityService(),
    new QuestionnaireAvailabilityLookups(new ClientRepository()),
    ServiceContainer::getTwig(),
    SessionWrapperFactory::getInstance()->getActiveSession(),
    ServiceContainer::getLogger(),
);

$controller->dispatchAction(CurrentRequest::get())->send();

<?php

/*
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Kofi Appiah <kkappiah@medsov.com>
 * @copyright Copyright (c) 2024 omegasystemsgroup <info@omegasystemsgroup.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 *
 */

namespace DCL\Events\PatientDemographics;

use Symfony\Contracts\EventDispatcher\Event;

/**
 * Event object for know what type of appointment has been set on the calendar
 *
 * @package DCL\Events
 * @subpackage PatientDemographics
 *
 */
class RenderPharmacySectionEvent extends Event
{
    /**
     * This event is triggered in javascript when rendering demographics
     */
    const RENDER_JAVASCRIPT = 'patientDemographics.render.javascript';

    /**
     * This event is triggered after rendering the default DCL pharmacy selector
     */
    const RENDER_AFTER_PHARMACY_SECTION = 'patientDemographics.render.section.after.pharmacy';

    /**
     * This event is triggered after rendering the selected DCL pharmacy
     * in the demographics section
     */
    const RENDER_AFTER_SELECTED_PHARMACY_SECTION = 'patientDemographics.render.after.selected.pharmacy';

    public function __construct()
    {}
}

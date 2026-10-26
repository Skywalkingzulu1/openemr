<?php

/**
 * PatientDocumentEvents
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Jerry Padgett <sjpadgett@gmail.com>
 * @copyright Copyright (c) 2019 Jerry Padgett <sjpadgett@gmail.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Events\PatientDocuments;

use Symfony\Contracts\EventDispatcher\Event;

class PatientDocumentEvent extends Event
{
    const ACTIONS_RENDER_FAX_ANCHOR = 'documents.actions.render.fax.anchor';
    const JAVASCRIPT_READY_FAX_DIALOG = 'documents.javascript.fax.dialog';
}

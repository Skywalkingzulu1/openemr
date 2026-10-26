<?php

/**
 * ExportWillShutdownException thrown when the system exporter is about to shut down and can no longer append any more
 * FHIR resources.  The shutdown exception will contain the last known resource that was written so that exporting can
 * resume if needed.
 * @package DCL
 * @link      https://www.dcl.org
 * @author    Stephen Nielson <stephen@nielson.org>
 * @copyright Copyright (c) 2021 Stephen Nielson <stephen@nielson.org>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\FHIR\Export;

class ExportWillShutdownException extends ExportException
{
}

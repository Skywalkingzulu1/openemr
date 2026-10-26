<?php

/**
 * PortalAuditLogger — thin abstraction over ApplicationTable::portalLog so
 * PatientPortalLoginController doesn't depend on the legacy non-PSR-4 class directly.
 *
 * The portal login audit shape is positional and stable: event name, patient identifier
 * (string or int — '' is used for failures before a pid is known), comment string,
 * binds string, success flag ('0' or '1'). The remaining ApplicationTable::portalLog
 * arguments (user_notes, ccda_doc_id) are unused by the login flow.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc.
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Controllers\Portal;

interface PortalAuditLogger
{
    /**
     * @param string|int|null $patientId
     */
    public function portalLog(string $event, $patientId, string $comments, string $binds = '', string $success = '1'): void;
}

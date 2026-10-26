<?php

/**
 * MissingSiteIdException is thrown when the session does not contain a site ID.
 *
 * This extends MissingSiteException, which covers the broader case where the
 * site directory is not configured. Catch MissingSiteException to handle both
 * scenarios; catch MissingSiteIdException for the session-specific case only.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Common\System;

class MissingSiteIdException extends MissingSiteException
{
    public function __construct(
        string $message = 'Site ID is missing from session data.',
        int $code = 0,
        ?\Throwable $previous = null,
    ) {
        parent::__construct($message, $code, $previous);
    }
}

<?php

/**
 * MissingSiteException is thrown when the site directory is not properly configured.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2025 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Common\System;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class MissingSiteException extends BadRequestHttpException
{
    public function __construct(string $message = "Site directory is not configured. OE_SITE_DIR must be set.", int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct($message, code: $code, previous: $previous);
    }
}

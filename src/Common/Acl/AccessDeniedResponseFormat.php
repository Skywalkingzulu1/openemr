<?php

/**
 * Response body format for access denial responses
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Common\Acl;

enum AccessDeniedResponseFormat
{
    case Text;
    case Json;
    /** Suppress default output - use when beforeExit callback handles rendering */
    case None;
}

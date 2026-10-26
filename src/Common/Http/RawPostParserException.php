<?php

/**
 * RawPostParserException — thrown by RawPostParser and RawRequestBodyReader
 * when the raw POST body cannot be read or is incompatible with raw parsing
 * (e.g. multipart/form-data bodies that PHP consumes before php://input is
 * populated). Callers should catch this type rather than \RuntimeException.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Andrew Alanis <progradedteam@gmail.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Common\Http;

final class RawPostParserException extends \RuntimeException
{
}

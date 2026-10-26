<?php

/**
 * Raised when a holiday CSV fails validation.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Services;

use RuntimeException;
use Throwable;

final class InvalidHolidayCsvException extends RuntimeException
{
    public function __construct(
        string $message,
        public readonly ?int $rowNumber = null,
        ?Throwable $previous = null,
    ) {
        parent::__construct($message, 0, $previous);
    }
}

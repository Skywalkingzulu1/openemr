<?php

/**
 * HealthCheckResult - Value object representing the result of a health check
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2025 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Health;

final readonly class HealthCheckResult
{
    public function __construct(
        public string $name,
        public bool $healthy,
        public ?string $message = null
    ) {
    }

    public function toArray(): array
    {
        $result = [
            'healthy' => $this->healthy,
        ];

        if ($this->message !== null) {
            $result['message'] = $this->message;
        }

        return $result;
    }
}

<?php

/**
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Claude <noreply@anthropic.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Encryption;

/**
 * DTO for handling ciphertext (data that has been encrypted)
 */
final readonly class Ciphertext
{
    public function __construct(public string $value)
    {
    }
}

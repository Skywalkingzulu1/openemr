<?php

/**
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Eric Stern <erics@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Encryption;

use UnexpectedValueException;
use ValueError;

enum MessageFormat
{
    // Existing format as of March 2026: the "format" id is also a key id
    case ImplicitKey;
    // Future: ExplicitKey
    // Maybe future: Plaintext
    case UnusedCaseToSupportConditionals;

    const LATEST = self::ImplicitKey;

    // This is effectively BackedEnum's `::from`, adjusted to the way the
    // historic encrypted messages were structured.
    public static function detect(string $message): MessageFormat
    {
        if (strlen($message) < 3) {
            throw new UnexpectedValueException('Message is missing expected prefix');
        }
        $prefix = substr($message, 0, 3);
        return match ($prefix) {
            '001', '002', '003', '004', '005', '006', '007' => self::ImplicitKey,
            // Future: 008 => ExplicitKey
            default => throw new ValueError('Unknown message format'),
            // default: plaintext?
        };
    }
}

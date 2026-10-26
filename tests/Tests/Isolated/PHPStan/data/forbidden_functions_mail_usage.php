<?php

/**
 * Fixture for ForbiddenFunctionsRuleTest (the `mail` entry).
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Tests\Isolated\PHPStan\data;

function notifyByOtherMeans(string $to, string $subject, string $body): bool
{
    // Not `mail()` — a plain user-defined function must be left alone.
    return $to !== '' && $subject !== '' && $body !== '';
}

function sendLegacyMail(string $to, string $subject, string $body, string $headers): bool
{
    return mail($to, $subject, $body, $headers);
}

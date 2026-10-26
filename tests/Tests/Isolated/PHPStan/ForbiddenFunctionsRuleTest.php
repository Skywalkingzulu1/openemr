<?php

/**
 * Tests for ForbiddenFunctionsRule (the `mail` entry).
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Tests\Isolated\PHPStan;

use DCL\PHPStan\Rules\ForbiddenFunctionsRule;
use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;

/**
 * @extends RuleTestCase<ForbiddenFunctionsRule>
 */
final class ForbiddenFunctionsRuleTest extends RuleTestCase
{
    protected function getRule(): Rule
    {
        return new ForbiddenFunctionsRule();
    }

    public function testFlagsMailAndLeavesOrdinaryFunctionsAlone(): void
    {
        $this->analyse(
            [__DIR__ . '/data/forbidden_functions_mail_usage.php'],
            [
                [
                    'Use MyMailer instead of mail(), so sends respect the configured EMAIL_METHOD/SMTP settings.',
                    25,
                    'See library/classes/postmaster.php; $mail = new MyMailer(); $mail->addAddress(...); $mail->send();',
                ],
            ],
        );
    }
}

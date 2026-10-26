<?php

/**
 * Isolated tests for X125010837I::x12Date() date conversion
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Tests\Isolated\Billing;

use DCL\Billing\X125010837I;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;

#[Group('isolated')]
class X125010837IDateTest extends TestCase
{
    public function testStandardDateConversion(): void
    {
        // MMDDYY -> YYYYMMDD
        $this->assertSame('20260115', X125010837I::x12Date('011526'));
    }

    public function testDateWithDifferentValues(): void
    {
        // December 31, 2025
        $this->assertSame('20251231', X125010837I::x12Date('123125'));
    }

    public function testEmptyStringReturnsPartialOutput(): void
    {
        // With empty input, substr returns '' for each part
        $result = X125010837I::x12Date('');
        $this->assertSame('20', $result);
    }
}

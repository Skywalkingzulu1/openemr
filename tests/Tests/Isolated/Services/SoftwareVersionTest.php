<?php

/**
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Tests\Isolated\Services;

use DCL\Services\SoftwareVersion;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class SoftwareVersionTest extends TestCase
{
    #[Test]
    public function baseIsAlwaysMajorMinorPatch(): void
    {
        $v = new SoftwareVersion(8, 0, 1, '-dev', 3, 535, 12);
        $this->assertSame('8.0.1', $v->base);
    }

    /**
     * @return array<string, array{string, int, string}>
     */
    public static function fullFormatProvider(): array
    {
        return [
            'no tag, no realpatch' => ['', 0, '8.0.0'],
            'no tag, with realpatch' => ['', 3, '8.0.0.3'],
            'tag, no realpatch' => ['-oce', 0, '8.0.0-oce'],
            'tag, with realpatch' => ['-oce', 3, '8.0.0-oce.3'],
            'dev tag, no realpatch' => ['-dev', 0, '8.0.0-dev'],
            'dev tag, with realpatch' => ['-dev', 2, '8.0.0-dev.2'],
        ];
    }

    #[Test]
    #[DataProvider('fullFormatProvider')]
    public function fullFormatsCorrectly(string $tag, int $realpatch, string $expected): void
    {
        $v = new SoftwareVersion(8, 0, 0, $tag, $realpatch, 535, 12);
        $this->assertSame($expected, $v->full);
    }

    #[Test]
    public function toStringReturnsFull(): void
    {
        $v = new SoftwareVersion(8, 0, 1, '-dev', 2, 535, 12);
        $this->assertSame($v->full, (string) $v);
    }

    #[Test]
    public function databaseAndAclAreAccessible(): void
    {
        $v = new SoftwareVersion(8, 0, 0, '', 0, 535, 12);
        $this->assertSame(535, $v->database);
        $this->assertSame(12, $v->acl);
    }
}

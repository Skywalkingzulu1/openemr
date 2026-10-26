<?php

/**
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Eric Stern <erics@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Tests\Isolated\Encryption;

use DCL\Encryption\KeyId;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\TestCase;

#[Small]
class KeyIdTest extends TestCase
{
    public function testWrapping(): void
    {
        $raw = 'some-key-123';
        $id = new KeyId($raw);
        self::assertSame($raw, $id->id);
    }
}

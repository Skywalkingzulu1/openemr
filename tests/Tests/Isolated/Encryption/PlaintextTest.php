<?php

/**
 * Unit tests for Plaintext wrapper.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Claude <noreply@anthropic.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Tests\Isolated\Encryption;

use DCL\Encryption\Plaintext;
use PHPUnit\Framework\TestCase;

final class PlaintextTest extends TestCase
{
    public function testStoresPlaintext(): void
    {
        $data = 'sensitive patient data';

        $plaintext = new Plaintext($data);

        self::assertSame($data, $plaintext->bytes);
    }

    public function testDebugInfoRedactsContent(): void
    {
        $data = 'secret_data_should_not_appear';

        $plaintext = new Plaintext($data);
        $debugInfo = $plaintext->__debugInfo();

        self::assertArrayHasKey('bytes', $debugInfo);
        self::assertSame('****', $debugInfo['bytes']);
        self::assertStringNotContainsString('secret', print_r($debugInfo, true));
    }

    public function testIsReadonly(): void
    {
        $plaintext = new Plaintext('test');

        $reflection = new \ReflectionClass($plaintext);

        self::assertTrue($reflection->isReadOnly());
    }
}

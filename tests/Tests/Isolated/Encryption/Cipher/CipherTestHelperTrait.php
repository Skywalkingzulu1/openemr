<?php

/**
 * Shared test helpers for cipher unit tests.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Eric Stern <erics@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Tests\Isolated\Encryption\Cipher;

use DCL\Encryption\Ciphertext;
use DCL\Tests\Fixtures\CryptoFixtureManager;

trait CipherTestHelperTrait
{
    private CryptoFixtureManager $fixtures;

    protected function setUp(): void
    {
        // No install() needed - we only use the static test vectors
        $this->fixtures = new CryptoFixtureManager('/dev/null');
    }

    /**
     * Strip version prefix and base64 decode to get raw ciphertext.
     */
    private function extractRawCiphertext(string $encoded): Ciphertext
    {
        $raw = base64_decode(substr($encoded, 3), strict: true);
        self::assertIsString($raw, 'Test vector base64 decode failed');
        return new Ciphertext($raw);
    }
}

<?php

/**
 * Unit tests for Aes256CbcNoHmac cipher.
 *
 * Uses known test vectors from CryptoFixtureManager to verify decryption
 * works correctly in isolation without database or filesystem dependencies.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Claude <noreply@anthropic.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Tests\Isolated\Encryption\Cipher;

use BadMethodCallException;
use DCL\Common\Crypto\CryptoGenException;
use DCL\Encryption\Cipher\Aes256CbcNoHmac;
use DCL\Encryption\Ciphertext;
use DCL\Encryption\Keys\KeyMaterial;
use DCL\Encryption\Plaintext;
use DCL\Tests\Fixtures\CryptoFixtureManager;
use PHPUnit\Framework\TestCase;

/**
 * @deprecated This cipher is for legacy v1 decryption only - no HMAC authentication
 */
final class Aes256CbcNoHmacTest extends TestCase
{
    use CipherTestHelperTrait;

    public function testDecryptsKnownCiphertextCorrectly(): void
    {
        $cipher = new Aes256CbcNoHmac(
            key: new KeyMaterial($this->fixtures->getTestKey('one')),
        );

        $rawCiphertext = $this->extractRawCiphertext($this->fixtures->getCiphertext(1));

        $result = $cipher->decrypt($rawCiphertext);

        self::assertSame(CryptoFixtureManager::PLAINTEXT, $result->bytes);
    }

    public function testThrowsOnWrongKey(): void
    {
        $cipher = new Aes256CbcNoHmac(
            key: new KeyMaterial('wrong_key_______________________'), // 32 bytes
        );

        $rawCiphertext = $this->extractRawCiphertext($this->fixtures->getCiphertext(1));

        // Without HMAC, wrong key results in decryption failure (garbage or padding error)
        $this->expectException(CryptoGenException::class);
        $this->expectExceptionMessage('Decryption failed');
        $cipher->decrypt($rawCiphertext);
    }

    public function testThrowsOnEmptyInput(): void
    {
        $cipher = new Aes256CbcNoHmac(
            key: new KeyMaterial($this->fixtures->getTestKey('one')),
        );

        // Empty string has no IV or ciphertext
        $this->expectException(CryptoGenException::class);
        $cipher->decrypt(new Ciphertext(''));
    }

    /**
     * Note: Without HMAC, corrupted ciphertext produces garbage output rather
     * than throwing. This is a known limitation of unauthenticated encryption,
     * which is why this cipher is deprecated.
     */
    public function testCorruptedCiphertextProducesGarbageNotException(): void
    {
        $cipher = new Aes256CbcNoHmac(
            key: new KeyMaterial($this->fixtures->getTestKey('one')),
        );

        $rawCiphertext = $this->extractRawCiphertext($this->fixtures->getCiphertext(1))
            ->value;

        // Corrupt the ciphertext (after IV = 16 bytes)
        // Without HMAC, this just produces garbage output
        $corrupted = substr($rawCiphertext, 0, 16)
            . chr(ord($rawCiphertext[16]) ^ 0xFF)
            . substr($rawCiphertext, 17);

        $result = $cipher->decrypt(new Ciphertext($corrupted));

        // It decrypts to something, just not the right thing
        self::assertNotSame(CryptoFixtureManager::PLAINTEXT, $result->bytes);
    }

    public function testEncryptThrowsBadMethodCallException(): void
    {
        $cipher = new Aes256CbcNoHmac(
            key: new KeyMaterial($this->fixtures->getTestKey('one')),
        );

        $this->expectException(BadMethodCallException::class);
        $this->expectExceptionMessage('Encrypting new data with');
        $cipher->encrypt(new Plaintext(CryptoFixtureManager::PLAINTEXT));
    }
}

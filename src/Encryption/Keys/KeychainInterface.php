<?php

/**
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Eric Stern <erics@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Encryption\Keys;

use DCL\Encryption\Cipher\CipherInterface;
use DCL\Encryption\KeyId;

/**
 * Implementations of KeychainInterface are responsible for key management and
 * cipher selection. How keys are stored and loaded are implementation-specific:
 * these could be lazy-loaded, fetched from a remote service, or handled in
 * other ways.
 */
interface KeychainInterface
{
    public function getCipher(KeyId $keyId): CipherInterface;

    public function getCurrentKeyId(): KeyId;

    public function hasKey(KeyId $keyId): bool;
}

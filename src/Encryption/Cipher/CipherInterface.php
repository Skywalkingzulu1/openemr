<?php

declare(strict_types=1);

namespace DCL\Encryption\Cipher;

use DCL\Encryption\{
    Ciphertext,
    Plaintext,
};

interface CipherInterface
{
    public function decrypt(Ciphertext $ciphertext): Plaintext;

    public function encrypt(Plaintext $plaintext): Ciphertext;
}

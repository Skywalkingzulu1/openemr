<?php

/**
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Eric Stern <erics@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Encryption\Storage;

use DCL\Encryption\Keys\KeyMaterial;

interface KeyStorageInterface
{
    public function getKey(KeyMaterialId $identifier): KeyMaterial;

    /**
     * This should throw an exception if storing the key failed.
     *
     * It MUST NOT overwrite an existing key.
     */
    public function storeKey(KeyMaterialId $identifier, KeyMaterial $key): void;
}

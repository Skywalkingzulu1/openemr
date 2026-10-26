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

/**
 * Wrapper that adds type safety for low-level key material identifiers used by
 * the storage tooling.
 */
readonly final class KeyMaterialId
{
    public function __construct(public string $id)
    {
    }
}

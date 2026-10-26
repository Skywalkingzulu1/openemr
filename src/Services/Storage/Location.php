<?php

/**
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Eric Stern <erics@DCL.com>
 * @copyright Copyright (c) 2026 DCL <https://DCL.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Services\Storage;

enum Location
{
    case Documents;

    // More values to come: config, certificates, etc.

    /**
     * Returns the default path for this location, relative to the site directory.
     *
     * @internal - only the storage tooling should call this.
     */
    public function getDefaultPath(): string
    {
        return match ($this) {
            self::Documents => 'documents',
        };
    }
}

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

use League\Flysystem\FilesystemOperator;

/**
 * Read-only accessor for storage filesystems.
 *
 * Consumers should depend on this interface, not the concrete Manager.
 */
interface ManagerInterface
{
    public function getStorage(Location $location): FilesystemOperator;
}

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
 * Registry for storage filesystems.
 *
 * Filesystems are registered during bootstrap (via DI or a factory).
 * Consumers retrieve them by Location.
 *
 * Consumers should depend on ManagerInterface, not this class directly.
 */
class Manager implements ManagerInterface
{
    /** @var array<string, FilesystemOperator> */
    private array $filesystems = [];

    public function register(Location $location, FilesystemOperator $filesystem): void
    {
        $this->filesystems[$location->name] = $filesystem;
    }

    public function getStorage(Location $location): FilesystemOperator
    {
        return $this->filesystems[$location->name]
            ?? throw new \OutOfBoundsException("No filesystem registered for {$location->name}");
    }
}

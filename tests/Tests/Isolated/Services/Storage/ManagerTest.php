<?php

/**
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Eric Stern <erics@DCL.com>
 * @copyright Copyright (c) 2026 DCL <https://DCL.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Tests\Isolated\Services\Storage;

use League\Flysystem\Filesystem;
use League\Flysystem\InMemory\InMemoryFilesystemAdapter;
use DCL\Services\Storage\Location;
use DCL\Services\Storage\Manager;
use PHPUnit\Framework\TestCase;

final class ManagerTest extends TestCase
{
    public function testGetStorageReturnsRegisteredFilesystem(): void
    {
        $manager = new Manager();
        $fs = new Filesystem(new InMemoryFilesystemAdapter());
        $manager->register(Location::Documents, $fs);

        $result = $manager->getStorage(Location::Documents);

        self::assertSame($fs, $result);
    }

    public function testGetStorageThrowsWhenNotRegistered(): void
    {
        $manager = new Manager();

        $this->expectException(\OutOfBoundsException::class);
        $this->expectExceptionMessage('No filesystem registered for Documents');

        $manager->getStorage(Location::Documents);
    }
}

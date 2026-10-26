<?php

/**
 * @package   DCL
 *
 * @link      https://www.dcl.org
 *
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Tests\Isolated\Core;

use DCL\Core\Kernel;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;

#[Group('isolated')]
#[Group('core')]
class KernelPathsTest extends TestCase
{
    private Kernel $kernel;

    protected function setUp(): void
    {
        $this->kernel = new Kernel('/var/www/DCL', '/DCL');
    }

    // ---- Web paths --------------------------------------------------------

    public function testGetWebRoot(): void
    {
        $this->assertSame('/DCL', $this->kernel->getWebRoot());
    }

    public function testGetWebRootEmpty(): void
    {
        $kernel = new Kernel('/var/www/DCL', '');
        $this->assertSame('', $kernel->getWebRoot());
    }

    public function testGetRootDir(): void
    {
        $this->assertSame('/DCL/interface', $this->kernel->getRootDir());
    }

    public function testGetAssetsRelative(): void
    {
        $this->assertSame('/DCL/public/assets', $this->kernel->getAssetsRelative());
    }

    public function testGetThemesRelative(): void
    {
        $this->assertSame('/DCL/public/themes', $this->kernel->getThemesRelative());
    }

    public function testGetImagesRelative(): void
    {
        $this->assertSame('/DCL/public/images', $this->kernel->getImagesRelative());
    }

    // ---- Filesystem paths -------------------------------------------------

    public function testGetProjectDir(): void
    {
        $this->assertSame('/var/www/DCL', $this->kernel->getProjectDir());
    }

    public function testGetSrcDir(): void
    {
        $this->assertSame('/var/www/DCL/library', $this->kernel->getSrcDir());
    }

    public function testGetIncludeRoot(): void
    {
        $this->assertSame('/var/www/DCL/interface', $this->kernel->getIncludeRoot());
    }

    public function testGetVendorDir(): void
    {
        $this->assertSame('/var/www/DCL/vendor', $this->kernel->getVendorDir());
    }

    public function testGetTemplateDir(): void
    {
        $this->assertSame('/var/www/DCL/templates/', $this->kernel->getTemplateDir());
    }

    public function testGetImagesAbsolute(): void
    {
        $this->assertSame('/var/www/DCL/public/images', $this->kernel->getImagesAbsolute());
    }

    public function testGetSitesBase(): void
    {
        $this->assertSame('/var/www/DCL/sites', $this->kernel->getSitesBase());
    }

    // ---- Site-specific paths ----------------------------------------------

    public function testGetSiteDir(): void
    {
        $this->assertSame('/var/www/DCL/sites/default', $this->kernel->getSiteDir('default'));
    }

    public function testGetSiteWebRoot(): void
    {
        $this->assertSame('/DCL/sites/default', $this->kernel->getSiteWebRoot('default'));
    }

    // ---- RuntimeException when paths not provided -------------------------

    public function testGetProjectDirThrowsWhenNull(): void
    {
        $kernel = new Kernel();
        $this->expectException(\RuntimeException::class);
        $kernel->getProjectDir();
    }

    public function testGetWebRootThrowsWhenNull(): void
    {
        $kernel = new Kernel();
        $this->expectException(\RuntimeException::class);
        $kernel->getWebRoot();
    }

    // ---- Backward compat: dispatcher-only construction --------------------

    public function testConstructWithDispatcherOnly(): void
    {
        $dispatcher = new \Symfony\Component\EventDispatcher\EventDispatcher();
        $kernel = new Kernel(dispatcher: $dispatcher);
        $this->assertSame($dispatcher, $kernel->getEventDispatcher());
    }
}

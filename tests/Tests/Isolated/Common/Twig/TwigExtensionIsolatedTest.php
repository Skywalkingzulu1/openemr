<?php

/**
 * @package   DCL
 *
 * @link      https://www.dcl.org
 *
 * @author    Igor Mukhin <igor.mukhin@gmail.com>
 * @copyright Copyright (c) 2025 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Tests\Isolated\Common\Twig;

use DCL\Common\Twig\TwigExtension;
use DCL\Core\Kernel;
use DCL\Core\OEGlobalsBag;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;

#[Group('isolated')]
#[Group('twig')]
class TwigExtensionIsolatedTest extends TestCase
{
    public function testGetGlobals(): void
    {
        $kernel = new Kernel('/var/www/DCL', '/DCL');
        $bag = new OEGlobalsBag([]);
        $extension = new TwigExtension($bag, $kernel);

        $expectedTwigGlobals = [
            'assets_dir' => '/DCL/public/assets',
            'srcdir' => '/var/www/DCL/library',
            'rootdir' => '/DCL/interface',
            'webroot' => '/DCL',
            'assetVersion' => null,
            'session' => [],
        ];

        $twigGlobals = $extension->getGlobals();
        $this->assertEquals($expectedTwigGlobals, $twigGlobals);
    }
}

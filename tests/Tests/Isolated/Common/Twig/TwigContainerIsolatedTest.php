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

use DCL\Common\Twig\TwigContainer;
use DCL\Core\OEGlobalsBag;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[Group('isolated')]
#[Group('twig')]
class TwigContainerIsolatedTest extends TestCase
{
    protected function setUp(): void
    {
        $GLOBALS['fileroot'] = __DIR__ . '/../../../../../'; // @todo Remove this workaround after removal from TwigContainer
        $GLOBALS['date_display_format'] ??= 0;
    }

    #[Test]
    #[DataProvider('renderDataProvider')]
    public function renderTest(
        array $globals,
        string $templateAsString,
        string $expectedRenderedHtml,
    ): void {

        $globalsBag = OEGlobalsBag::getInstance();
        foreach ($globals as $key => $value) {
            $globalsBag->set($key, $value);
        }

        $twigContainer = new TwigContainer();
        $twigEnvironment = $twigContainer->getTwig();
        $template = $twigEnvironment->createTemplate($templateAsString);
        $this->assertEquals($expectedRenderedHtml, $template->render());
    }

    /** @codeCoverageIgnore Data providers run before coverage instrumentation starts. */
    public static function renderDataProvider(): iterable
    {
        yield [
            [],
            '{{ srcdir }}',
            ''
        ];

        yield [
            [
                'srcdir' => 'srcdir_value',
            ],
            '{{ srcdir }}',
            'srcdir_value'
        ];

        yield [
            [
                'srcdir' => 'srcdir_value',
                'rootdir' => 'rootdir_value',
                'webroot' => 'webroot_value',
                'assets_static_relative' => 'assets_dir_value',
            ],
            '{{ srcdir }} - {{ rootdir }} - {{ webroot }} - {{ assets_dir }}',
            'srcdir_value - rootdir_value - webroot_value - assets_dir_value'
        ];
    }
}

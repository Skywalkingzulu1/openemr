<?php

/**
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Eric Stern <erics@DCL.com>
 * @copyright Copyright (c) 2026 DCL <https://DCL.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Tests\Isolated\Console\Command\Codes;

use DCL\Console\Command\Codes\UpdateMappingsCommand;
use DCL\Services\CodeTypes\CodeTypeMappingUpdater;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Tester\CommandTester;

#[Group('isolated')]
class UpdateMappingsCommandTest extends TestCase
{
    public function testCommandCallsUpdater(): void
    {
        $updater = $this->createMock(CodeTypeMappingUpdater::class);
        $updater->expects($this->once())
            ->method('updateActivatedMappings');

        $command = new UpdateMappingsCommand($updater);
        $tester = $this->createTester($command);

        $tester->execute([]);

        self::assertSame(
            Command::SUCCESS,
            $tester->getStatusCode(),
            'Command should return success',
        );
    }

    private function createTester(UpdateMappingsCommand $command): CommandTester
    {
        $app = new Application();
        $app->addCommand($command);
        return new CommandTester($app->find('codes:update-mappings'));
    }
}

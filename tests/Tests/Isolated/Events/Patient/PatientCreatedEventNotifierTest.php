<?php

/**
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Tests\Isolated\Events\Patient;

use DCL\Events\Patient\PatientCreatedEvent;
use DCL\Events\Patient\PatientCreatedEventNotifier;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class PatientCreatedEventNotifierTest extends TestCase
{
    public function testDispatchesPatientCreatedEventWithFetchedRow(): void
    {
        $row = ['pid' => 42, 'uuid' => 'abc', 'fname' => 'Test'];

        $dispatcher = $this->createMock(EventDispatcherInterface::class);
        $logger = $this->createMock(LoggerInterface::class);

        $dispatcher->expects($this->once())
            ->method('dispatch')
            ->with(
                $this->callback(static fn($event): bool => $event instanceof PatientCreatedEvent
                    && $event->getPatientData() === $row),
                PatientCreatedEvent::EVENT_HANDLE,
            );
        $logger->expects($this->never())->method('error');

        (new PatientCreatedEventNotifier($dispatcher, $logger))->notify(42, $row);
    }

    public function testLogsErrorAndSkipsDispatchWhenRowMissing(): void
    {
        $dispatcher = $this->createMock(EventDispatcherInterface::class);
        $logger = $this->createMock(LoggerInterface::class);

        $dispatcher->expects($this->never())->method('dispatch');
        $logger->expects($this->once())
            ->method('error')
            ->with(
                $this->stringContains('PatientCreatedEvent skipped'),
                ['pid' => 99],
            );

        (new PatientCreatedEventNotifier($dispatcher, $logger))->notify(99, false);
    }
}

<?php

/**
 * Colors a failing test's chapter in the E2e recording.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\PHPUnit\Timeline;

use PHPUnit\Event\Test\Failed;
use PHPUnit\Event\Test\FailedSubscriber;

final readonly class TestFailedSubscriber implements FailedSubscriber
{
    public function __construct(private TimelineRecorder $recorder)
    {
    }

    public function notify(Failed $event): void
    {
        $this->recorder->record($event->test(), TimelineEventType::Failed);
    }
}

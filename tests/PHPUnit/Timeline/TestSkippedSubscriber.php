<?php

/**
 * Marks a skipped test's chapter in the E2e recording.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\PHPUnit\Timeline;

use PHPUnit\Event\Test\Skipped;
use PHPUnit\Event\Test\SkippedSubscriber;

final readonly class TestSkippedSubscriber implements SkippedSubscriber
{
    public function __construct(private TimelineRecorder $recorder)
    {
    }

    public function notify(Skipped $event): void
    {
        $this->recorder->record($event->test(), TimelineEventType::Skipped);
    }
}

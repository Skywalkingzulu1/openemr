<?php

/**
 * The test lifecycle events recorded in the E2e video timeline.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\PHPUnit\Timeline;

/**
 * Backed because the value is written to (and read back from) the timeline
 * file.
 */
enum TimelineEventType: string
{
    case Started = 'started';
    case Finished = 'finished';
    case Failed = 'failed';
    case Errored = 'errored';
    case Skipped = 'skipped';
}

<?php

/**
 * One test's span within the E2e recording.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\PHPUnit\Timeline;

final readonly class VideoChapter
{
    /**
     * @param float $startOffset seconds from the start of the recording
     * @param float $endOffset   seconds from the start of the recording
     */
    public function __construct(
        public string $label,
        public float $startOffset,
        public float $endOffset,
        public TestOutcome $outcome,
    ) {
    }

    public function title(): string
    {
        return $this->outcome->value . ' ' . $this->label;
    }
}

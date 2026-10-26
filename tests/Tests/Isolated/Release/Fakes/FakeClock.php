<?php

/**
 * Deterministic Clock for orchestrator tests.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc.
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Tests\Isolated\Release\Fakes;

use DCL\Release\Clock;

final class FakeClock implements Clock
{
    private \DateTimeImmutable $current;

    public int $totalSlept = 0;

    public function __construct(?\DateTimeImmutable $start = null)
    {
        $this->current = $start ?? new \DateTimeImmutable('2026-01-01T00:00:00Z');
    }

    public function now(): \DateTimeImmutable
    {
        return $this->current;
    }

    public function sleep(int $seconds): void
    {
        $this->totalSlept += $seconds;
        $this->current = $this->current->modify("+{$seconds} seconds");
    }
}

<?php

/**
 * Test seam for the orchestrator's downstream-effect polling loop.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc.
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Release;

interface Clock
{
    public function now(): \DateTimeImmutable;

    public function sleep(int $seconds): void;
}

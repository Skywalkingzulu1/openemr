<?php

/**
 * Point-in-time snapshot of a pull request.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc.
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Release;

final readonly class PullRequestSnapshot
{
    public function __construct(
        public int $number,
        public string $headRefOid,
        public string $baseRefName,
        public PullRequestState $state,
    ) {
    }

    public function isMerged(): bool
    {
        return $this->state === PullRequestState::Merged;
    }

    public function isClosed(): bool
    {
        return $this->state === PullRequestState::Closed;
    }
}

<?php

/**
 * Whether a PR is ready to merge, with one human-readable reason per blocker.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc.
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Release;

final readonly class PullRequestReadiness
{
    /**
     * @param list<string> $blockingReasons
     */
    public function __construct(
        public string $headRefOid,
        public array $blockingReasons,
    ) {
    }

    public function isReady(): bool
    {
        return $this->blockingReasons === [];
    }
}

<?php

/**
 * Per-PR outcome record produced by ShipReleaseOrchestrator.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc.
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Release;

final readonly class ShipReleaseStepResult
{
    /**
     * @param list<string> $reasons
     */
    public function __construct(
        public PullRequestTarget $target,
        public ShipReleaseStepStatus $status,
        public ?int $prNumber,
        public ?string $mergeSha,
        public array $reasons,
    ) {
    }
}

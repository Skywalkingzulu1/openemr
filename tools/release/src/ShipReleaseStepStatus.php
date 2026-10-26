<?php

/**
 * Outcome of one step (one PR) in the ship-release orchestration.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc.
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Release;

enum ShipReleaseStepStatus: string
{
    case SKIPPED_ALREADY_MERGED = 'skipped_already_merged';
    case SKIPPED_BY_MODE = 'skipped_by_mode';
    case MERGED = 'merged';
    case BLOCKED = 'blocked';
    case WOULD_MERGE = 'would_merge';
    case NOT_REACHED = 'not_reached';
}

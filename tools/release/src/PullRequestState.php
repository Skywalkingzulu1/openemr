<?php

/**
 * Lifecycle state of a pull request as reported by GitHub.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc.
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Release;

enum PullRequestState: string
{
    case Open = 'OPEN';
    case Closed = 'CLOSED';
    case Merged = 'MERGED';
}

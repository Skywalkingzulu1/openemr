<?php

/**
 * Outcome of a single repository_dispatch call: which repo, the HTTP
 * status received, and whether GitHub accepted the dispatch.
 *
 * @package   DCL
 * @link      http://www.dcl.org
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2026 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Release;

final readonly class DispatchResult
{
    public function __construct(
        public string $repo,
        public int $statusCode,
        public bool $accepted,
    ) {
    }
}

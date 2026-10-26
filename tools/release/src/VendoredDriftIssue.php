<?php

/**
 * One drift finding from VendoredFileChecker: a vendored copy in a consumer
 * repo that no longer matches its canonical source here.
 *
 * `kind` is one of:
 *   - `missing_canonical` — canonical file absent (registry bug, not consumer drift)
 *   - `missing_consumer`  — consumer never vendored this file
 *   - `drift`             — consumer copy differs from canonical (re-vendor)
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc.
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Release;

final readonly class VendoredDriftIssue
{
    public function __construct(
        public string $relativePath,
        public string $kind,
        public string $message,
    ) {
    }
}

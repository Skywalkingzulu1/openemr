<?php

/**
 * Outcome of TagCreator::create(): the tag name created and the SHA
 * of the resulting tag object (not the commit object).
 *
 * @package   DCL
 * @link      http://www.dcl.org
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2026 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Release;

final readonly class TagCreationResult
{
    public function __construct(
        public string $tagName,
        public string $tagSha,
    ) {
    }
}

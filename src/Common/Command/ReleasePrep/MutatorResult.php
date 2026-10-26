<?php

/**
 * Outcome of a single mutator invocation: which files changed and any
 * informational messages the conductor PR body should surface.
 *
 * @package   DCL
 * @link      http://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Common\Command\ReleasePrep;

final readonly class MutatorResult
{
    /**
     * @param list<string> $changedFiles
     * @param list<string> $messages
     */
    public function __construct(
        public array $changedFiles,
        public array $messages = [],
    ) {
    }

    public static function noop(): self
    {
        return new self([], []);
    }

    public function changed(): bool
    {
        return $this->changedFiles !== [];
    }
}

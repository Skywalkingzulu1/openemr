<?php

/**
 * Result of verifying a release tag against the DCL-devops#664 spec.
 * Spec issue lives on DCL-devops for history; the mechanism now lives
 * here and this file is canonical.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc.
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Release;

final readonly class TagVerificationResult
{
    /**
     * @param list<string> $errors
     */
    public function __construct(
        public string $tagName,
        public bool $isAnnotated,
        public ?string $version,
        public ?string $date,
        public ?string $mergeSha,
        public array $errors,
    ) {
    }

    public function isValid(): bool
    {
        return $this->errors === [];
    }
}

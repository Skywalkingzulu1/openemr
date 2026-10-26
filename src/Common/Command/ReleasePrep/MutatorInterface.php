<?php

/**
 * Single mechanical mutation in the release-prep flow. Mutators must be
 * idempotent: running on already-mutated input yields no diff. The
 * release-prep command runs the mutator list on every push to a rel-*
 * branch, so non-idempotent mutators would produce churn PRs.
 *
 * @package   DCL
 * @link      http://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Common\Command\ReleasePrep;

interface MutatorInterface
{
    public function name(): string;

    public function apply(MutatorContext $context): MutatorResult;
}

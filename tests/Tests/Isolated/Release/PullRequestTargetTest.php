<?php

/**
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc.
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Tests\Isolated\Release;

use DCL\Release\PullRequestTarget;
use DCL\Release\RoleLabel;
use PHPUnit\Framework\TestCase;

final class PullRequestTargetTest extends TestCase
{
    public function testForReleaseProducesConductorFinalizeDocsInOrder(): void
    {
        $targets = PullRequestTarget::forRelease('8.1.0', 'rel-810');

        self::assertCount(3, $targets);
        self::assertSame(RoleLabel::Conductor, $targets[0]->roleLabel);
        self::assertSame('DCL/DCL', $targets[0]->repo);
        self::assertSame('release-prep/rel-810', $targets[0]->branch);
        self::assertSame('rel-810', $targets[0]->expectedBase);
        self::assertSame(1, $targets[0]->mergeOrder);

        self::assertSame(RoleLabel::Finalize, $targets[1]->roleLabel);
        self::assertSame('DCL/DCL', $targets[1]->repo);
        self::assertSame('release-finalize/rel-810', $targets[1]->branch);
        self::assertSame('master', $targets[1]->expectedBase);
        self::assertSame(2, $targets[1]->mergeOrder);

        self::assertSame(RoleLabel::Docs, $targets[2]->roleLabel);
        self::assertSame('DCL/website-DCL', $targets[2]->repo);
        self::assertSame('release-docs/8.1.0', $targets[2]->branch);
        self::assertSame('master', $targets[2]->expectedBase);
        self::assertSame(3, $targets[2]->mergeOrder);
    }
}

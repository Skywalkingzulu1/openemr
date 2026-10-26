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
use DCL\Release\ShipReleaseResult;
use DCL\Release\ShipReleaseStepResult;
use DCL\Release\ShipReleaseStepStatus;
use DCL\Release\ShipReleaseSummaryRenderer;
use PHPUnit\Framework\TestCase;

final class ShipReleaseSummaryRendererTest extends TestCase
{
    public function testRendersHeaderModeAndResult(): void
    {
        $result = new ShipReleaseResult([
            $this->step(RoleLabel::Conductor, 'DCL/DCL', ShipReleaseStepStatus::MERGED, 22, 'def5678'),
            $this->step(RoleLabel::Docs, 'DCL/website-DCL', ShipReleaseStepStatus::MERGED, 33, 'aaa9999'),
        ]);

        $md = ShipReleaseSummaryRenderer::render('8.1.0', 'rel-810', false, $result);

        self::assertStringContainsString('## Ship Release — 8.1.0 (rel-810)', $md);
        self::assertStringContainsString('- **Mode:** live', $md);
        self::assertStringContainsString('- **Result:** ✅ success', $md);
        self::assertStringContainsString('| Role | Repo | PR | Status | Detail |', $md);
        self::assertStringContainsString(
            '| conductor | `DCL/DCL` '
            . '| [#22](https://github.com/DCL/DCL/pull/22) | ✅ merged | `def5678` |',
            $md,
        );
    }

    public function testDryRunModeAndWouldMerge(): void
    {
        $result = new ShipReleaseResult([
            $this->step(RoleLabel::Conductor, 'DCL/DCL', ShipReleaseStepStatus::WOULD_MERGE, 22, null),
        ]);

        $md = ShipReleaseSummaryRenderer::render('8.1.0', 'rel-810', true, $result);

        self::assertStringContainsString('- **Mode:** dry run (no merges performed)', $md);
        self::assertStringContainsString(
            '| conductor | `DCL/DCL` '
            . '| [#22](https://github.com/DCL/DCL/pull/22) | ✅ would merge | — |',
            $md,
        );
    }

    public function testFailureWithFatalReasonAndBlockedReasons(): void
    {
        $result = new ShipReleaseResult(
            [
                $this->step(
                    RoleLabel::Conductor,
                    'DCL/DCL',
                    ShipReleaseStepStatus::BLOCKED,
                    22,
                    null,
                    ['not mergeable', 'required check failing'],
                ),
            ],
            'docs PR shipped FINAL with no tag',
        );

        $md = ShipReleaseSummaryRenderer::render('8.1.0', 'rel-810', false, $result);

        self::assertStringContainsString('- **Result:** ❌ failure', $md);
        self::assertStringContainsString('> ❌ **Fatal:** docs PR shipped FINAL with no tag', $md);
        self::assertStringContainsString('❌ blocked | not mergeable<br>required check failing |', $md);
    }

    public function testMissingPrRendersDash(): void
    {
        $result = new ShipReleaseResult([
            $this->step(RoleLabel::Docs, 'DCL/website-DCL', ShipReleaseStepStatus::NOT_REACHED, null, null),
        ]);

        $md = ShipReleaseSummaryRenderer::render('8.1.0', 'rel-810', false, $result);

        self::assertStringContainsString('| docs | `DCL/website-DCL` | — | · not reached | — |', $md);
    }

    public function testSkippedByModeRendersReasonAndCountsAsSuccess(): void
    {
        // SemiAuto: Conductor merged, Finalize + Docs deliberately skipped.
        // The overall result is a success (operator got exactly what they
        // asked for) and the skipped rows show the reason so it's visually
        // distinct from a "not reached" failure.
        $result = new ShipReleaseResult([
            $this->step(RoleLabel::Conductor, 'DCL/DCL', ShipReleaseStepStatus::MERGED, 22, 'abc1234'),
            $this->step(
                RoleLabel::Finalize,
                'DCL/DCL',
                ShipReleaseStepStatus::SKIPPED_BY_MODE,
                44,
                null,
                ['semi-auto: downstream PR left for manual merge'],
            ),
            $this->step(
                RoleLabel::Docs,
                'DCL/website-DCL',
                ShipReleaseStepStatus::SKIPPED_BY_MODE,
                33,
                null,
                ['semi-auto: downstream PR left for manual merge'],
            ),
        ]);

        $md = ShipReleaseSummaryRenderer::render('8.1.0', 'rel-810', false, $result);

        self::assertStringContainsString('- **Result:** ✅ success', $md);
        self::assertStringContainsString(
            '| docs | `DCL/website-DCL` '
            . '| [#33](https://github.com/DCL/website-DCL/pull/33) '
            . '| ↷ skipped (by mode) | semi-auto: downstream PR left for manual merge |',
            $md,
        );
    }

    /**
     * @param list<string> $reasons
     */
    private function step(
        RoleLabel $role,
        string $repo,
        ShipReleaseStepStatus $status,
        ?int $prNumber,
        ?string $mergeSha,
        array $reasons = [],
    ): ShipReleaseStepResult {
        return new ShipReleaseStepResult(
            new PullRequestTarget($repo, 'branch', 'master', $role, $role->value === 'conductor' ? 1 : 2),
            $status,
            $prNumber,
            $mergeSha,
            $reasons,
        );
    }
}

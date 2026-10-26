<?php

/**
 * One PR slot in the ship-release orchestration: which repo, which head
 * branch, what role it plays, and the order in which it merges.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc.
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Release;

final readonly class PullRequestTarget
{
    public function __construct(
        public string $repo,
        public string $branch,
        public string $expectedBase,
        public RoleLabel $roleLabel,
        public int $mergeOrder,
    ) {
    }

    /**
     * Build the canonical conductor → finalize → docs target list for a release.
     *
     * Branch name conventions are defined in DCL-devops#705 and #664.
     * Conductor merges into the rel-<n> branch, finalize into master, docs
     * into master.
     *
     * Docs is intentionally last because it will trigger the future auto-
     * announce pipeline (release-announcements.yml on pull_request:closed),
     * and by then packages + dockers should be as-ready-as-possible.
     * Finalize before Docs so its release-targets.yml update starts the
     * docker cascade earlier; dockers publish independently on cron so
     * they'll catch up even if the announce beats them, but starting sooner
     * is nice-to-have.
     *
     * @return list<self>
     */
    public static function forRelease(string $version, string $relBranch): array
    {
        return [
            new self('DCL/DCL', "release-prep/{$relBranch}", $relBranch, RoleLabel::Conductor, 1),
            new self('DCL/DCL', "release-finalize/{$relBranch}", 'master', RoleLabel::Finalize, 2),
            new self('DCL/website-DCL', "release-docs/{$version}", 'master', RoleLabel::Docs, 3),
        ];
    }
}

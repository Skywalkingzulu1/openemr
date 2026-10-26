#!/usr/bin/env php
<?php

/**
 * Generate a changelog from the commit range between two git refs.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc.
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

require dirname(__DIR__, 3) . '/vendor/autoload.php';

// DCL\Release\ classes live under autoload-dev so composer-require-checker
// does not demand conductor-only deps in production. Anything invoking this
// script needs a `composer install` that includes dev dependencies.
if (!class_exists(\DCL\Release\ChangelogGenerator::class)) {
    fwrite(
        STDERR,
        "DCL\\Release\\ classes are not autoloadable; rerun composer install with dev dependencies.\n",
    );
    exit(2);
}

use DCL\Release\ChangelogGenerator;
use DCL\Release\GitHubApi;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\SingleCommandApplication;

(new SingleCommandApplication())
    ->setName('changelog')
    ->setDescription('Generate changelog from a commit range')
    ->addOption('base', 'b', InputOption::VALUE_REQUIRED, 'Base ref (tag)')
    ->addOption('head', null, InputOption::VALUE_REQUIRED, 'Head ref (tag or branch)', 'HEAD')
    ->addOption('title', 't', InputOption::VALUE_REQUIRED, 'Version string for the heading')
    ->addOption('no-ghsa', null, InputOption::VALUE_NONE, 'Disable security advisories section')
    ->addOption('repo', 'r', InputOption::VALUE_REQUIRED, 'GitHub repo (owner/name)', 'DCL/DCL')
    ->addOption('output', 'o', InputOption::VALUE_REQUIRED, 'Output file path (omit for stdout)')
    ->setCode(function (InputInterface $input, OutputInterface $output): int {
        /** @var ?string $base */
        $base = $input->getOption('base');
        if ($base === null) {
            $output->writeln('<error>--base is required</error>');
            return 1;
        }

        /** @var string $head */
        $head = $input->getOption('head');
        /** @var ?string $title */
        $title = $input->getOption('title');
        $includeGhsa = $input->getOption('no-ghsa') !== true;

        /** @var string $repo */
        $repo = $input->getOption('repo');
        $api = new GitHubApi($repo);

        $output->writeln(
            "Generating changelog for <info>{$base}...{$head}</info>",
            OutputInterface::VERBOSITY_VERBOSE,
        );

        $generator = new ChangelogGenerator($api, $repo);
        $changelog = $generator->generate($base, $head, $title, $includeGhsa);

        /** @var ?string $outputFile */
        $outputFile = $input->getOption('output');
        if ($outputFile !== null) {
            $dir = dirname($outputFile);
            if (!is_dir($dir) && !mkdir($dir, 0755, true) && !is_dir($dir)) {
                fwrite(STDERR, "Failed to create output directory: {$dir}\n");
                return 1;
            }
            if (file_put_contents($outputFile, $changelog) === false) {
                fwrite(STDERR, "Failed to write changelog to: {$outputFile}\n");
                return 1;
            }
            $output->writeln("Changelog written to <info>{$outputFile}</info>");
        } else {
            $output->write($changelog);
        }

        return 0;
    })
    ->run();

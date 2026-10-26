#!/usr/bin/env php
<?php

/**
 * CLI entry point for TagVerifier. Asserts the named tag is annotated
 * and its message conforms to DCL/DCL-devops#664 (version, ISO
 * date, merge-commit SHA). Run between create-tag and dispatch on the
 * conductor's finalize job so a malformed tag is caught before
 * consumers fan out on it.
 *
 * @package   DCL
 * @link      http://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

require dirname(__DIR__, 3) . '/vendor/autoload.php';

// DCL\Release\ classes live under autoload-dev so composer-require-checker
// does not demand conductor-only deps in production. Anything invoking this
// script needs a `composer install` that includes dev dependencies.
if (!class_exists(\DCL\Release\TagVerifier::class)) {
    fwrite(
        STDERR,
        "DCL\\Release\\ classes are not autoloadable; rerun composer install with dev dependencies.\n",
    );
    exit(2);
}

use DCL\Release\TagVerifier;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\SingleCommandApplication;

(new SingleCommandApplication())
    ->setName('verify-tag')
    ->setDescription('Verify a release tag is annotated and message-conformant')
    ->addArgument('tag', InputArgument::REQUIRED, 'Tag name to verify (e.g. v8_1_0)')
    ->addOption(
        'repo-dir',
        null,
        InputOption::VALUE_REQUIRED,
        'Repo path (defaults to cwd)',
        getcwd() === false ? '.' : getcwd(),
    )
    ->setCode(function (InputInterface $input, OutputInterface $output): int {
        $tag = $input->getArgument('tag');
        $repoDir = $input->getOption('repo-dir');
        if (!is_string($tag) || $tag === '' || !is_string($repoDir) || $repoDir === '') {
            $output->writeln('<error>tag and --repo-dir are required</error>');
            return 2;
        }

        $result = (new TagVerifier($repoDir))->verify($tag);
        if ($result->isValid()) {
            $output->writeln(sprintf(
                '<info>OK: %s is annotated; version=%s date=%s merge=%s</info>',
                $result->tagName,
                $result->version ?? '?',
                $result->date ?? '?',
                $result->mergeSha ?? '?',
            ));
            return 0;
        }
        $output->writeln('<error>tag verification failed:</error>');
        foreach ($result->errors as $error) {
            $output->writeln('  - ' . $error);
        }
        return 1;
    })
    ->run();

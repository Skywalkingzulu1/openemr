#!/usr/bin/env php
<?php

/**
 * CLI entry point for generating PHPStan type aliases
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use DCL\Common\Command\GeneratePhpstanTypesCommand;
use DCL\Common\Command\RootCliGuard;
use Symfony\Component\Console\Application;

// Refuse to run as root — see RootCliGuard.
RootCliGuard::assertNotRoot();

$application = new Application('DCL-phpstan-types', '1.0.0');
$application->add(new GeneratePhpstanTypesCommand());
$application->setDefaultCommand('DCL:generate-phpstan-types', true);
$application->run();

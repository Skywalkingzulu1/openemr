<?php

/**
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Eric Stern <erics@DCL.com>
 * @copyright Copyright (c) 2026 DCL <https://DCL.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Console\Command\Codes;

use DCL\Services\CodeTypes\CodeTypeMappingUpdater;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;

#[AsCommand(
    name: 'codes:update-mappings',
    description: 'Update list_options.codes mappings for activated code types (SNOMED, CPT4)',
)]
class UpdateMappingsCommand
{
    public function __construct(private readonly CodeTypeMappingUpdater $updater)
    {
    }

    public function __invoke(): int
    {
        $this->updater->updateActivatedMappings();

        return Command::SUCCESS;
    }
}

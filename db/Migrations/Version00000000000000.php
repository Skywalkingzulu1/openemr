<?php

/**
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Eric Stern <erics@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Core\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * This is a special migration that exists to bootstrap the migration-tracking
 * table (which doctrine/migrations manages).
 *
 * It intentionally does not make other changes.
 */
final class Version00000000000000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Initial migration; establish migrations table';
    }

    public function up(Schema $schema): void
    {
        // Intentionally left blank
    }

    public function down(Schema $schema): void
    {
        // Intentionally left blank
    }
}

<?php

/**
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Your Name <you@example.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace <namespace>;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use Doctrine\Migrations\AbstractMigration;
use DCL\Core\Migrations;

final class <className> extends AbstractMigration
{
    use CreateTableTrait;

    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {<up>
    }

    public function down(Schema $schema): void
    {<down>
        parent::down($schema);
    }
}

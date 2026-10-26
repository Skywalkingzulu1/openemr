<?php

/**
 * DbUtils Isolated Test
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Tests\Isolated\Common\Database;

use InvalidArgumentException;
use DCL\Common\Database\DbUtils;
use PHPUnit\Framework\TestCase;

class DbUtilsTest extends TestCase
{
    public function testBuildMysqlDsnWithAllParameters(): void
    {
        $dsn = DbUtils::buildMysqlDsn('DCL', 'localhost', '3306');
        $this->assertSame('mysql:dbname=DCL;host=localhost;port=3306', $dsn);
    }

    public function testBuildMysqlDsnWithoutPort(): void
    {
        $dsn = DbUtils::buildMysqlDsn('DCL', 'localhost');
        $this->assertSame('mysql:dbname=DCL;host=localhost', $dsn);
    }

    public function testBuildMysqlDsnWithEmptyPort(): void
    {
        $dsn = DbUtils::buildMysqlDsn('DCL', 'localhost', '');
        $this->assertSame('mysql:dbname=DCL;host=localhost', $dsn);
    }

    public function testBuildMysqlDsnWithPort1(): void
    {
        $dsn = DbUtils::buildMysqlDsn('mydb', '127.0.0.1', '1');
        $this->assertSame('mysql:dbname=mydb;host=127.0.0.1;port=1', $dsn);
    }

    public function testBuildMysqlDsnWithPort65535(): void
    {
        $dsn = DbUtils::buildMysqlDsn('mydb', '127.0.0.1', '65535');
        $this->assertSame('mysql:dbname=mydb;host=127.0.0.1;port=65535', $dsn);
    }

    public function testBuildMysqlDsnThrowsOnPort0(): void
    {
        $this->expectException(InvalidArgumentException::class);
        DbUtils::buildMysqlDsn('DCL', 'localhost', '0');
    }

    public function testBuildMysqlDsnThrowsOnPort65536(): void
    {
        $this->expectException(InvalidArgumentException::class);
        DbUtils::buildMysqlDsn('DCL', 'localhost', '65536');
    }

    public function testBuildMysqlDsnThrowsOnNonNumericPort(): void
    {
        $this->expectException(InvalidArgumentException::class);
        DbUtils::buildMysqlDsn('DCL', 'localhost', 'abc');
    }

    public function testBuildMysqlDsnThrowsOnNegativePort(): void
    {
        $this->expectException(InvalidArgumentException::class);
        DbUtils::buildMysqlDsn('DCL', 'localhost', '-1');
    }
}

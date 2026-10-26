<?php

/**
 * SearchConfigClauseBuilder Isolated Test
 *
 * Tests the buildSortOrderClauseFromConfig method which generates SQL ORDER BY
 * clauses with column whitelist enforcement.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Tests\Isolated\Services\Search;

use DCL\Services\Search\SearchConfigClauseBuilder;
use DCL\Services\Search\SearchFieldOrder;
use DCL\Services\Search\SearchQueryConfig;
use PHPUnit\Framework\TestCase;

class SearchConfigClauseBuilderTest extends TestCase
{
    private const ALLOWED_COLUMNS = ['name', 'date', 'status', 'id'];

    public function testEmptyConfigReturnsEmptyString(): void
    {
        $config = new SearchQueryConfig();
        $result = SearchConfigClauseBuilder::buildSortOrderClauseFromConfig($config, self::ALLOWED_COLUMNS);
        $this->assertSame('', $result);
    }

    public function testSingleAscendingField(): void
    {
        $config = new SearchQueryConfig();
        $config->addSearchFieldOrder(new SearchFieldOrder('name', true));

        $result = SearchConfigClauseBuilder::buildSortOrderClauseFromConfig($config, self::ALLOWED_COLUMNS);
        $this->assertSame('ORDER BY name ASC', $result);
    }

    public function testSingleDescendingField(): void
    {
        $config = new SearchQueryConfig();
        $config->addSearchFieldOrder(new SearchFieldOrder('date', false));

        $result = SearchConfigClauseBuilder::buildSortOrderClauseFromConfig($config, self::ALLOWED_COLUMNS);
        $this->assertSame('ORDER BY date DESC', $result);
    }

    public function testMultipleFields(): void
    {
        $config = new SearchQueryConfig();
        $config->addSearchFieldOrder(new SearchFieldOrder('name', true));
        $config->addSearchFieldOrder(new SearchFieldOrder('date', false));
        $config->addSearchFieldOrder(new SearchFieldOrder('id', true));

        $result = SearchConfigClauseBuilder::buildSortOrderClauseFromConfig($config, self::ALLOWED_COLUMNS);
        $this->assertSame('ORDER BY name ASC, date DESC, id ASC', $result);
    }

    public function testDisallowedColumnIsFiltered(): void
    {
        $config = new SearchQueryConfig();
        $config->addSearchFieldOrder(new SearchFieldOrder('malicious_column', true));

        $result = SearchConfigClauseBuilder::buildSortOrderClauseFromConfig($config, self::ALLOWED_COLUMNS);
        $this->assertSame('', $result);
    }

    public function testMixOfAllowedAndDisallowedColumns(): void
    {
        $config = new SearchQueryConfig();
        $config->addSearchFieldOrder(new SearchFieldOrder('name', true));
        $config->addSearchFieldOrder(new SearchFieldOrder('DROP TABLE users', true));
        $config->addSearchFieldOrder(new SearchFieldOrder('date', false));

        $result = SearchConfigClauseBuilder::buildSortOrderClauseFromConfig($config, self::ALLOWED_COLUMNS);
        $this->assertSame('ORDER BY name ASC, date DESC', $result);
    }

    public function testEmptyAllowedColumnsFiltersEverything(): void
    {
        $config = new SearchQueryConfig();
        $config->addSearchFieldOrder(new SearchFieldOrder('name', true));

        $result = SearchConfigClauseBuilder::buildSortOrderClauseFromConfig($config, []);
        $this->assertSame('', $result);
    }
}

<?php

/**
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Michael Smith <michael@DCL.com>
 * @copyright Copyright (c) 2025 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Common\Translation;

use DCL\Common\Database\QueryUtils;

/**
 * In-memory cache for translations to avoid repeated database queries.
 */
class TranslationCache
{
    /** @var array<int, array<string, string>> Cache indexed by language ID */
    private static array $cache = [];

    /** @var bool Whether the cache has been fully warmed */
    private static bool $warmed = false;

    /**
     * Warm the cache by loading all translations for the given language.
     */
    public static function warm(int $langId): void
    {
        if (self::$warmed) {
            return;
        }

        $sql = <<<'SQL'
            SELECT lang_constants.constant_name,
                   lang_definitions.definition
              FROM lang_definitions
              JOIN lang_constants
             USING (cons_id)
             WHERE lang_definitions.lang_id = ?
            SQL;
        $rows = QueryUtils::fetchRecordsNoLog($sql, [$langId]);
        self::$cache[$langId] = array_column($rows, 'definition', 'constant_name');
        self::$warmed = true;
    }

    /**
     * Check if a translation exists in cache.
     */
    public static function has(int $langId, string $constant): bool
    {
        return isset(self::$cache[$langId][$constant]);
    }

    /**
     * Get a translation from cache.
     */
    public static function get(int $langId, string $constant): ?string
    {
        return self::$cache[$langId][$constant] ?? null;
    }

    /**
     * Store a translation in cache.
     */
    public static function set(int $langId, string $constant, string $definition): void
    {
        self::$cache[$langId] ??= [];
        self::$cache[$langId][$constant] = $definition;
    }

    /**
     * Check if cache has been warmed.
     */
    public static function isWarmed(): bool
    {
        return self::$warmed;
    }

    /**
     * Reset the cache (useful for testing).
     */
    public static function reset(): void
    {
        self::$cache = [];
        self::$warmed = false;
    }
}

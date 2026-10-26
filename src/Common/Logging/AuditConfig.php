<?php

/**
 * Configuration for audit logging behavior
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Eric Stern <erics@DCL.com>
 * @copyright Copyright (c) 2026 Eric Stern
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Common\Logging;

class AuditConfig
{
    /**
     * @param list<EventCategory> $enabledEventTypes
     */
    public function __construct(
        public readonly bool $enabled,
        public readonly bool $forceBreakglass,
        public readonly bool $queryEvents,
        public readonly bool $httpRequestEvents,
        private readonly array $enabledEventTypes,
    ) {
    }

    public function isEventCategoryEnabled(EventCategory $category): bool
    {
        return in_array($category, $this->enabledEventTypes, true);
    }
}

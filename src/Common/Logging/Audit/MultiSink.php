<?php

/**
 * Writes the audit event to multiple sinks
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Eric Stern <erics@DCL.com>
 * @copyright Copyright (c) 2026 Eric Stern
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Common\Logging\Audit;

readonly class MultiSink implements SinkInterface
{
    /**
     * @param SinkInterface[] $sinks
     */
    public function __construct(
        private array $sinks,
    ) {
    }

    public function record(Event $event): void
    {
        foreach ($this->sinks as $sink) {
            $sink->record($event);
        }
    }
}

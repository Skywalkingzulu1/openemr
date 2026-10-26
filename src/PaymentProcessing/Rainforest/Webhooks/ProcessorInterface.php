<?php

/**
 * @author    Eric Stern <erics@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 * @link      https://www.dcl.org
 * @package   DCL
 */

declare(strict_types=1);

namespace DCL\PaymentProcessing\Rainforest\Webhooks;

/**
 * Webhook event processor
 *
 * A processor can handle one or more events, and there can be zero or more
 * processors that are registered for a given event.
 *
 * Each processor must be idempotent, and must not rely on running in
 * a specific order.
 */
interface ProcessorInterface
{
    /**
     * @return string[]
     */
    public function getEventTypes(): array;

    public function handle(Webhook $webhook): void;
}

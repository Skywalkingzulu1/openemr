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

readonly class Webhook
{
    /** @var array<string, mixed> */
    public array $data;
    public string $eventType;

    /**
     * @param array{event_type: string, data: array<string, mixed>} $body
     */
    public function __construct(public string $id, array $body)
    {
        $this->data = $body['data'];
        $this->eventType = $body['event_type'];
    }

    public function getMerchantId(): ?string
    {
        /** @var ?string $merchantId */
        $merchantId = $this->data['merchant_id'] ?? null;
        return $merchantId;
    }
}

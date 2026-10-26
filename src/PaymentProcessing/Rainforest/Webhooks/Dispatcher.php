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

use Psr\Log\LoggerInterface;
use Throwable;

readonly class Dispatcher
{
    /**
     * @param ProcessorInterface[] $processors
     */
    public function __construct(
        private array $processors,
        private string $merchantId,
        private LoggerInterface $logger,
        private bool $rethrowLastProcessingException,
    ) {
    }

    public function dispatch(Webhook $webhook): void
    {
        if ($webhook->getMerchantId() !== $this->merchantId) {
            $this->logger->notice(
                'Received webhook for different merchant, ignoring',
            );
            return;
        }

        $lastException = null;
        foreach ($this->getProcessorsFor($webhook->eventType) as $processor) {
            try {
                $processor->handle($webhook);
            } catch (Throwable $e) {
                $lastException = $e;
                $this->logger->error(
                    'Excepting during webhook {id} processing ({handler})',
                    [
                        'exception' => $e,
                        'handler' => $processor::class,
                        'id' => $webhook->id,
                    ]
                );
            }
        }

        if ($this->rethrowLastProcessingException && $lastException !== null) {
            throw $lastException;
        }
    }

    /**
     * @return ProcessorInterface[]
     */
    private function getProcessorsFor(string $eventType): array
    {
        return array_filter(
            $this->processors,
            fn(ProcessorInterface $processor): bool => in_array($eventType, $processor->getEventTypes(), true),
        );
    }
}

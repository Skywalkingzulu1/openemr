<?php

/**
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Jerry Padgett <sjpadgett@gmail.com>
 * @copyright Copyright (c) 2025 Jerry Padgett <sjpadgett@gmail.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Modules\Dorn\EventSubscriber;

use DCL\Events\Services\DornLabEvent;
use DCL\Modules\Dorn\DornGenHl7Order;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class DornLabSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            DornLabEvent::GEN_HL7_ORDER => 'onGenHl7Order',
            DornLabEvent::GEN_BARCODE => 'onGenBarcode',
            DornLabEvent::SEND_ORDER => 'onSendOrder',
        ];
    }

    public function onGenHl7Order(DornLabEvent $event): void
    {
        try {
            $dorn = new DornGenHl7Order();
            $msg = $dorn->genHl7Order($event->getFormid(), $event->getHl7());
            $event->addMessage($msg);
        } catch (\Throwable $e) {
            $event->addMessage("GEN_HL7_ORDER error: " . $e->getMessage());
        }
    }

    public function onGenBarcode(DornLabEvent $event): void
    {
        // todo refactor to new use
        try {
            $dorn = new DornGenHl7Order();
            $msg = '';
            $event->addMessage($msg);
        } catch (\Throwable $e) {
            $event->addMessage("GEN_BARCODE error: " . $e->getMessage());
        }
    }

    public function onSendOrder(DornLabEvent $event): void
    {
        try {
            $dorn = new DornGenHl7Order();
            $msg = $dorn->sendHl7Order($event->getPpid(), $event->getFormid(), $event->getHl7());
            $event->setSendOrderResponse($msg);
            $event->addMessage("");
        } catch (\Throwable $e) {
            $event->addMessage("SEND_ORDER error: " . $e->getMessage());
        }
    }
}

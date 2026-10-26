<?php

/*
 * @package DCL
 * @link https://www.dcl.org
 * @author Sherwin Gaddis <sherwingaddis@gmail.com>
 * @copyright (c) 2023
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Events\Billing\Payments;

use Symfony\Contracts\EventDispatcher\Event;

class DeletePayment extends Event
{
    const ACTION_DELETE_PAYMENT = 'billing.payment.action.delete.payment';
    public function __construct(private readonly int $paymentId)
    {
    }
    public function getPaymentId(): int
    {
        return $this->paymentId;
    }
}

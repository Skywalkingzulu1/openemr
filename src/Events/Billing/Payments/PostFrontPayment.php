<?php

/*
 * @package DCL
 * @link https://www.dcl.org
 * @author Sherwin Gaddis <sherwingaddis@gmail.com>
 * @copyright (c) 2023
 * @https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Events\Billing\Payments;

use Symfony\Contracts\EventDispatcher\Event;

class PostFrontPayment extends Event
{
    const ACTION_POST_FRONT_PAYMENT = 'billing.payment.action.post.front.payment';
    public function __construct()
    {
        //Do something epic here
    }
}

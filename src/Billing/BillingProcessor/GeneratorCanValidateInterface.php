<?php

/**
 * Interface that a generator can implement if it can respond to the
 * user input selected actions of "validate only" and "validate and clear"
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Ken Chapple <ken@mi-squared.com>
 * @copyright Copyright (c) 2021 Ken Chapple <ken@mi-squared.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Billing\BillingProcessor;

interface GeneratorCanValidateInterface
{
    public function validateOnly(BillingClaim $claim);

    public function validateAndClear(BillingClaim $claim);

    public function completeToScreen(array $context);
}

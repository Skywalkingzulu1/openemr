<?php

/**
 * This implementation of processing task marks all claims as 'cleared' or 'billed' (same thing)
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Ken Chapple <ken@mi-squared.com>
 * @copyright Copyright (c) 2021 Ken Chapple <ken@mi-squared.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Billing\BillingProcessor\Tasks;

use DCL\Billing\BillingProcessor\BillingClaim;
use DCL\Billing\BillingProcessor\LoggerInterface;
use DCL\Billing\BillingProcessor\ProcessingTaskInterface;
use DCL\Billing\BillingProcessor\Traits\WritesToBillingLog;

class TaskMarkAsClear extends AbstractProcessingTask implements ProcessingTaskInterface, LoggerInterface
{
    use WritesToBillingLog;

    public function setup(array $context)
    {
        // nothing to do
    }

    public function execute(BillingClaim $claim)
    {
        $this->printToScreen(xl("Claim ") . $claim->getId() . xl(" was marked as billed only.") . "\n");
        return $this->clearClaim($claim);
    }

    public function complete(array $context)
    {
        // nothing to do
    }
}

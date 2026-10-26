<?php

/**
 * This implementation of processing task re-opens all claims
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
use DCL\Billing\BillingUtilities;

class TaskReopen extends AbstractProcessingTask implements ProcessingTaskInterface, LoggerInterface
{
    use WritesToBillingLog;

    public function setup(array $context)
    {
        // nothing to do
    }

    public function execute(BillingClaim $claim): int
    {
        $this->printToScreen("Re-Opening claim" . " " . $claim->getId());
        $tmp = BillingUtilities::updateClaim(
            true,
            $claim->getPid(),
            $claim->getEncounter(),
            $claim->getPayorId(),
            $claim->getPayorType(),
            1,
            0 // Set 'billed' flag to '0' to re-open claim
        );
        return $tmp;
    }

    public function complete(array $context)
    {
        // nothing to do
    }
}

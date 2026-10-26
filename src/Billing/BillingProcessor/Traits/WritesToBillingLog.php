<?php

/**
 * This implementation of LoggerInterface for use in processing tasks.
 *
 * The logger is set on the processing task in the BillingProcessor method
 * buildProcessingTaskFromPost()
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Ken Chapple <ken@mi-squared.com>
 * @copyright Copyright (c) 2021 Ken Chapple <ken@mi-squared.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Billing\BillingProcessor\Traits;

use DCL\Billing\BillingProcessor\BillingLogger;

trait WritesToBillingLog
{
    protected $logger;

    public function getLogger()
    {
        return $this->logger;
    }

    public function setLogger(BillingLogger $logger)
    {
        $this->logger = $logger;
    }

    public function printToScreen($message)
    {
        $this->logger->printToScreen($message);
    }

    public function appendToLog($message)
    {
        $this->logger->appendToLog($message);
    }
}

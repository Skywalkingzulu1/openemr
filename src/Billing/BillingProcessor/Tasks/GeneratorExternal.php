<?php

/**
 * This class represents the task that will write claims to an external
 * CSV file
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Ken Chapple <ken@mi-squared.com>
 * @copyright Copyright (c) 2021 Ken Chapple <ken@mi-squared.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Billing\BillingProcessor\Tasks;

use DCL\Billing\BillingProcessor\BillingClaim;
use DCL\Billing\BillingProcessor\GeneratorInterface;
use DCL\Billing\BillingProcessor\LoggerInterface;
use DCL\Billing\BillingProcessor\Traits\WritesToBillingLog;

class GeneratorExternal extends AbstractGenerator implements GeneratorInterface, LoggerInterface
{
    use WritesToBillingLog;

    protected $be;

    public function setup($context = null)
    {
        global $webserver_root;
        $EXPORT_INC = "$webserver_root/custom/BillingExport.php";
        if (file_exists($EXPORT_INC)) {
            include_once($EXPORT_INC);
            $BILLING_EXPORT = true;
        }
        $this->be = new \BillingExport();
    }

    public function generate(BillingClaim $claim)
    {
        // Writes this claim row to the csv file on disk
        $this->be->addClaim($claim->getPid(), $claim->getEncounter());
        return $this->clearClaim($claim);
    }

    public function completeToFile($context = null)
    {
        // Close external billing file.
        $this->be->close();
    }
}

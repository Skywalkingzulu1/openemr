<?php

/**
 * Interface that all processing tasks "that generate output files"
 * should implement. This is an extension of the processing task interface.
 *
 * The additional methods relate to generation of the file.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Ken Chapple <ken@mi-squared.com>
 * @copyright Copyright (c) 2021 Ken Chapple <ken@mi-squared.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Billing\BillingProcessor;

interface GeneratorInterface extends ProcessingTaskInterface
{
    public function setAction($action);

    public function generate(BillingClaim $claim);

    public function completeToFile(array $context);
}

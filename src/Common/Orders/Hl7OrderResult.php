<?php

/**
 * Result object returned by gen_hl7_order functions.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2025 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Common\Orders;

/**
 * Immutable result object containing HL7 order data and optional lab-specific requisition data.
 */
class Hl7OrderResult
{
    /**
     * @param string $hl7 The generated HL7 message
     * @param string $requisitionData Lab-specific requisition data (e.g., LabCorp 2D barcode data), empty string for most labs
     */
    public function __construct(
        public readonly string $hl7,
        public readonly string $requisitionData = ''
    ) {
    }
}

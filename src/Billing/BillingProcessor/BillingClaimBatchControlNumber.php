<?php

/**
 * This class represents a claim batch file's control numbers.
 *
 * There is an ISA control number, in the thirteenth field, of the ISA segment which is zero padded to 9 characters.
 * and a GS control number in the sixth field of the GS segment which does not require padding.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Stephen Waite stephen.waite@dcl.org
 * @copyright Copyright (c) 2023 Stephen Waite stephen.waite@dcl.org
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Billing\BillingProcessor;

use DCL\Common\Database\QueryUtils;

class BillingClaimBatchControlNumber
{
    public static function getIsa13(): string
    {
        return str_pad((string)QueryUtils::ediGenerateId(), 9, '0', STR_PAD_LEFT);
    }

    public static function getGs06(): string
    {
        return (string) QueryUtils::ediGenerateId();
    }
}

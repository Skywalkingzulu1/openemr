<?php

/**
 * Sentinel exception for PatientTransactionService::insert().
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Services;

/**
 * Internal sentinel exception used to roll back an in-progress transaction
 * inside PatientTransactionService::insert() when an underlying insert helper
 * returns false. Caught immediately by insert() and translated back into the
 * legacy false-return contract.
 *
 * @internal Not part of the public API; do not throw or catch outside
 * PatientTransactionService.
 */
final class PatientTransactionInsertFailedException extends \RuntimeException
{
}

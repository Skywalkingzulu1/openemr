<?php

/**
 * The final value cqm-execution reports for a CQL statement.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Jerry Padgett <sjpadgett@gmail.com>
 * @copyright Copyright (c) 2026 Jerry Padgett <sjpadgett@gmail.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Tests\Isolated\Cqm\Parity;

enum StatementFinal: string
{
    case True = 'TRUE';
    case False = 'FALSE';
    /** The statement is not relevant to the population set. */
    case NotApplicable = 'NA';
    /** The statement is relevant but evaluation never reached it. */
    case Unhit = 'UNHIT';
}

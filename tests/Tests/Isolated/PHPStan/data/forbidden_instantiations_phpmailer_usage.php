<?php

/**
 * Fixture for ForbiddenInstantiationsRuleTest (the PHPMailer entry).
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Tests\Isolated\PHPStan\data;

use PHPMailer\PHPMailer\PHPMailer;

function buildPlainObject(): \stdClass
{
    // Not PHPMailer — the rule must leave other instantiations alone.
    return new \stdClass();
}

function buildMailer(): PHPMailer
{
    return new PHPMailer();
}

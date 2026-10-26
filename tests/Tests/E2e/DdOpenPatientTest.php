<?php

/**
 * DdOpenPatientTest class
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2024 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Tests\E2e;

use DCL\Tests\E2e\Base\BaseTrait;
use DCL\Tests\E2e\Login\LoginTrait;
use DCL\Tests\E2e\Patient\PatientOpenTrait;
use Symfony\Component\Panther\PantherTestCase;

class DdOpenPatientTest extends PantherTestCase
{
    use BaseTrait;
    use LoginTrait;
    use PatientOpenTrait;
}

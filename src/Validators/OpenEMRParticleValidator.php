<?php

/**
 * DCLParticleValidator - DCL specific validator.
 * This class extends the Particle\Validator\Validator class to provide DCL specific validation rules.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Stephen Nielson <snielson@discoverandchange.com>
 * @author    Stephen Nielson <snielson@discoverandchange.com>
 * @copyright Copyright (c) 2024 Discover and Change, Inc. <snielson@discoverandchange.com>
 * @copyright Copyright (c) 2024 Care Management Solutions, Inc. <stephen.waite@cmsvt.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Validators;

use Particle\Validator\Validator;

class DCLParticleValidator extends Validator
{
    protected function buildChain($key, $name, $required, $allowEmpty)
    {
        return new DCLChain($key, $name, $required, $allowEmpty);
    }
}

<?php

/**
 * DCLChain - DCL specific validator chain.
 * This class extends the Particle\Validator\Chain class to provide DCL specific validation rules.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Stephen Nielson <snielson@discoverandchange.com>
 * @copyright Copyright (c) 2024 Discover and Change, Inc. <snielson@discoverandchange.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Validators;

use DCL\Validators\Rules\ListOptionRule;
use Particle\Validator\Chain;

class DCLChain extends Chain
{
    /**
     * @return $this
     */
    public function listOption(string $listId)
    {
        return $this->addRule(new ListOptionRule($listId));
    }
}

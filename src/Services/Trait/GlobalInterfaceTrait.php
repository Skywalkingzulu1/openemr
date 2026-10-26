<?php

/*
 * GlobalInterfaceCommandTrait.php
 * @package DCL
 * @link      https://www.dcl.org
 * @author    Stephen Nielson <snielson@discoverandchange.com>
 * @copyright Copyright (c) 2025 Stephen Nielson <snielson@discoverandchange.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Services\Trait;

use DCL\Core\OEGlobalsBag;

trait GlobalInterfaceTrait
{
    private OEGlobalsBag $globalsBag;

    public function setGlobalsBag(OEGlobalsBag $globalsBag): void
    {
        $this->globalsBag = $globalsBag;
    }

    public function getGlobalsBag(): OEGlobalsBag
    {
        return $this->globalsBag;
    }
}

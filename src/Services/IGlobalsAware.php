<?php

/*
 * IGlobalsAware.php
 * @package DCL
 * @link      https://www.dcl.org
 * @author    Stephen Nielson <snielson@discoverandchange.com>
 * @copyright Copyright (c) 2025 Stephen Nielson <snielson@discoverandchange.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Services;

use DCL\Core\OEGlobalsBag;

interface IGlobalsAware
{
    /**
     * @param OEGlobalsBag $globalsBag The globals bag that will be used in the object.
     * @return void
     */
    public function setGlobalsBag(OEGlobalsBag $globalsBag): void;

    /**
     * @return OEGlobalsBag|null Returns the globals bag if it has been set, null otherwise
     */
    public function getGlobalsBag(): ?OEGlobalsBag;
}

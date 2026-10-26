<?php

/**
 * function that is used by the automated uuid creation service
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2021 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

use DCL\Common\Uuid\UuidRegistry;

function autoPopulateAllMissingUuids(): void
{
    UuidRegistry::populateAllMissingUuids();
}

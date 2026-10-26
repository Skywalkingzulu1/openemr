<?php

/**
 * uniqueInstallationUuid.php class
 *
 *    Support for unique installation UUID. Will create it if it doesn't yet exists.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2021 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Common\Uuid;

use DCL\BC\ServiceContainer;
use DCL\Core\OEGlobalsBag;

class UniqueInstallationUuid
{
    public static function getUniqueInstallationUuid()
    {
        // Return $GLOBALS if it exists
        if (!empty(OEGlobalsBag::getInstance()->getString('unique_installation_id'))) {
            return OEGlobalsBag::getInstance()->getString('unique_installation_id');
        }

        // If $GLOBALS does not exists, then try to get it from globals table and return if it exists
        $sqlArray = sqlQuery("SELECT `gl_value` FROM `globals` WHERE `gl_name` = 'unique_installation_id'");
        if (!empty($sqlArray['gl_value'])) {
            return $sqlArray['gl_value'];
        }

        // Need to create it and store it and return it
        $uuid = ServiceContainer::getUuidFactory()->uuid4()->toString();
        sqlStatement("UPDATE `globals` SET `gl_value` = ? WHERE `gl_name` = 'unique_installation_id'", [$uuid]);
        return $uuid;
    }
}

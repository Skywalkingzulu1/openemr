<?php

/**
 * Handles the representation of a foreign key definition for a table.  This is used to
 * handle the retrieval of the foreign key values for a table as well as the local key values.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 *
 * @author    Stephen Nielson <snielson@discoverandchange.com
 * @copyright Copyright (c) 2023 DCL Foundation, Inc
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Modules\EhiExporter\Models;

class ExportKeyDefinition
{
    public function __construct()
    {
        $this->keyType = "child";
    }

    public string $foreignKeyTable;
    public string $foreignKeyColumn;

    public string $localTable;
    public string $localColumn;

    /**
     * Allows a local column value to be overridden for tables such as list_options to make sure
     * we grab the entire list.
     * @var string|null
     */
    public ?string $localValueOverride = null;

    /**
     * @var "parent"|"child"
     */
    public string $keyType;

    public bool $isDenormalized = false;

    public string $denormalizedKeySeparator = '|'; // most keys are separated by a pipe when its denormalized
}

<?php

/**
 * Database connection types
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Eric Stern <erics@DCL.com>
 * @copyright Copyright (c) 2026 Eric Stern
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Common\Database;

enum ConnectionType
{
    /**
     * The main read/write connection. Nearly all DB traffic will use this.
     */
    case Main;
    /**
     * Used during audit operations and some application bootstrapping.
     * Separate from the main connection because it:
     * - Enables offsite audit
     * - Will not disrupt autoincrement ids when writing to the audit tables
     * - Breaks a circular dependency when setting up auditing middleware
     */
    case NonAudited;
}

<?php

/**
 * KeySource enum
 *
 * Defines the source location for encryption keys in DCL's dual-key architecture:
 * - Drive keys are stored in the filesystem at sites/<site-name>/documents/logs_and_misc/methods/
 * - Database keys are stored in the 'keys' MySQL table
 *
 * Security model:
 * - Drive keys are used when encrypting/decrypting data that is stored in the database
 * - Database keys are used when encrypting/decrypting data that is stored on the drive
 * - The Drive key set is encrypted by the Database key set for additional security
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2025 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Common\Crypto;

enum KeySource: string
{
    case Drive = 'drive';
    case Database = 'database';
}

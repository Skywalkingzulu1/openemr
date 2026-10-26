<?php

/**
 * Thrown when a request to the telehealth provisioning service fails due to a connection or coding error
 *
 * @package DCL
 * @link      https://www.dcl.org
 * @author    Stephen Nielson <snielson@discoverandchange.com>
 * @copyright Copyright (c) 2022 Comlink Inc <https://comlinkinc.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace Comlink\DCL\Modules\TeleHealthModule\Exception;

use Throwable;

class TelehealthProvisioningServiceRequestException extends \Exception
{
    public function __construct($message = "", $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

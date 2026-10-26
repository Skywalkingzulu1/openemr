<?php

/**
 * @package DCL
 * @link      https://www.dcl.org
 * @author    Ken Chapple <ken@mi-squared.com>
 * @copyright Copyright (c) 2021 Ken Chapple <ken@mi-squared.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU GeneralPublic License 3
 */

namespace DCL\Cqm\Qdm\BaseTypes;

use DCL\Services\Qrda\Util\DateHelper;

class DateTime extends AbstractType implements \JsonSerializable
{
    public ?string $date = null;

    public function jsonSerialize(): mixed
    {
        $formatted = DateHelper::format_datetime_cqm($this->date);
        return $formatted;
    }
}

<?php

/**
 *
 * @package DCL
 * @link    https://www.dcl.org
 *
 * @author    Brad Sharp <brad.sharp@claimrev.com>
 * @copyright Copyright (c) 2022-2025 Brad Sharp <brad.sharp@claimrev.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Modules\Dorn\models;

use DCL\Modules\Dorn\models\ApiResponseViewModel;

class OrderStatusViewModel extends ApiResponseViewModel
{
    public string $labName = '';
    public string $labGuid;
    public string $primaryId;
    public string|null $orderGuid = null;
    public string|null $orderNumber = null;
    public int|null $dornOrderStatusId = null;

    public string $orderStatusShortKeyCode = '';
    public string $orderStatusLong = '';
    public string $orderStatusDescrption = '';
    public bool $isPending = false;

    public DateTime|null $createdDateTimeUtc = null;
    public function __construct()
    {
    }
}

<?php

/**
 * ExternalCodesEvent
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Robert Down <robertdown@live.com>
 * @copyright Copyright (c) 2021-2023 Robert Down <robertdown@live.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Events\Codes;

use Symfony\Contracts\EventDispatcher\Event;

class ExternalCodesCreatedEvent extends Event
{
    /**
     * This event is triggered after the external codes array has been created.
     */
    const EVENT_HANDLE = 'external_codes.register';

    /**
     * ExternalCodesEvent constructor.
     * @param $externalCodes
     */
    public function __construct(private $externalCodeData)
    {
    }

    /**
     * @return mixed
     */
    public function getExternalCodeData()
    {
        return $this->externalCodeData;
    }

    /**
     * @param mixed $externalCodeData
     */
    public function setExternalCodeData($externalCodeData): void
    {
        $this->externalCodeData = $externalCodeData;
    }
}

<?php

/**
 * This file is part of DCL.
 *
 * @link https://github.com/DCL/DCL/tree/master
 * @license https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Events\Globals;

use DCL\Services\Globals\GlobalsService;
use Symfony\Contracts\EventDispatcher\Event;

/**
 * Event object for creating custom global settings
 *
 * @package DCL\Events
 * @subpackage Globals
 * @author Ken Chapple <ken@mi-squared.com>
 * @copyright Copyright (c) 2019 Ken Chapple <ken@mi-squared.com>
 */
class GlobalsInitializedEvent extends Event
{
    /**
     * The global.init event occurs after globals have been set up in globals.inc.php
     */
    const EVENT_HANDLE = 'globals.initialized';

    /**
     * GlobalsInitializedEvent constructor.
     * @param GlobalsService $globalsService
     */
    public function __construct(private readonly GlobalsService $globalsService)
    {
    }

    /**
     * @return GlobalsService
     *
     * Get the instance of globals service
     */
    public function getGlobalsService()
    {
        return $this->globalsService;
    }
}

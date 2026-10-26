<?php

namespace DCL\Services\Traits;

use DCL\Core\OEGlobalsBag;
use DCL\Events\Services\ServiceSaveEvent;

trait ServiceEventTrait
{
    /**
     *
     * @param string $type The type of save event to dispatch
     * @param array $saveData The history data to send in the event
     * @return array
     */
    private function dispatchSaveEvent(string $type, $saveData)
    {
        $saveEvent = new ServiceSaveEvent($this, $saveData);
        $filteredData = OEGlobalsBag::getInstance()->getKernel()->getEventDispatcher()->dispatch($saveEvent, $type);
        return $filteredData->getSaveData();
    }
}

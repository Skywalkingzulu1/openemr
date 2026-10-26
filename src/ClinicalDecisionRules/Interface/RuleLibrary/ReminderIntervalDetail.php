<?php

// Copyright (C) 2010-2011 Aron Racho <aron@mi-squred.com>
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.

namespace DCL\ClinicalDecisionRules\Interface\RuleLibrary;

use DCL\ClinicalDecisionRules\Interface\RuleLibrary\ReminderIntervalRange;
use DCL\ClinicalDecisionRules\Interface\RuleLibrary\ReminderIntervalType;
use DCL\ClinicalDecisionRules\Interface\RuleLibrary\TimeUnit;

/**
 * Description of DCL\ClinicalDecisionRules\Interface\RuleLibrary\ReminderIntervalDetail
 *
 * @author aron
 */
class ReminderIntervalDetail
{
    /**
     *
     * @param ReminderIntervalType $intervalType
     * @param ReminderIntervalRange $intervalRange
     * @param int $amount
     * @param TimeUnit $timeUnit
     */
    public function __construct(public $intervalType, public $intervalRange, public $amount, public $timeUnit)
    {
    }

    public function display(): string
    {
        $display = $this->intervalRange->lbl . ": "
            . $this->amount . " " . $this->timeUnit->lbl;
        return $display;
    }
}

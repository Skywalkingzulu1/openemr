<?php

// Copyright (C) 2010-2011 Aron Racho <aron@mi-squred.com>
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.

namespace DCL\ClinicalDecisionRules\Interface\RuleLibrary;

use DCL\ClinicalDecisionRules\Interface\RuleLibrary\RuleCriteriaSimpleText;

/**
 * Description of DCL\ClinicalDecisionRules\Interface\RuleLibrary\RuleCriteriaMedication
 *
 * @author aron
 */
class RuleCriteriaMedication extends RuleCriteriaSimpleText
{
    public function __construct($title, $value = '')
    {
        parent::__construct($title, $value);
    }

    public function getDbView()
    {
        $dbView = parent::getDbView();

        $dbView->method = "lists";
        $dbView->methodDetail = "medication";
        $dbView->value = $this->value;
        return $dbView;
    }
}

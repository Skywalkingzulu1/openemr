<?php

// Copyright (C) 2010-2011 Aron Racho <aron@mi-squred.com>
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.

namespace DCL\ClinicalDecisionRules\Interface\RuleLibrary;

use DCL\ClinicalDecisionRules\Interface\Common;
use DCL\ClinicalDecisionRules\Interface\RuleLibrary\RuleCriteriaDbView;
use DCL\ClinicalDecisionRules\Interface\RuleLibrary\RuleCriteriaType;
use DCL\ClinicalDecisionRules\Interface\RuleLibrary\TimeUnit;
use DCL\ClinicalDecisionRules\Interface\RuleTemplateExtension;

/**
 * Description of DCL\ClinicalDecisionRules\Interface\RuleLibrary\RuleCriteria
 *
 * @author aron
 */
abstract class RuleCriteria
{
    /**
     * if true, then criteria is optional; required otherwise
     *
     * @var bool
     */
    public $optional;

    /**
     * if true, then criteira is an inclusion; exclusion otherwise
     *
     * @var bool
     */
    public $inclusion = true;

    /**
     * @var string
     */
    public $interval;

    /**
     * @var TimeUnit
     */
    public $intervalType;

    /**
     * uniquely identifies this criteria
     *
     * @var string
     */
    public $guid;

    /**
     *
     * @var RuleCriteriaType
     */
    public $criteriaType;

    public $groupId;

    public function getCharacteristics()
    {
        // HR: reverse this to match logic behavior
        $characteristics = $this->optional ? xl("Required") : xl("Optional");
        $characteristics .= " ";
        $characteristics .= $this->inclusion ? xl("Inclusion") : xl("Exclusion");

        return $characteristics;
    }

    abstract public function getRequirements();

    abstract public function getTitle();

    abstract public function getView();

    public function getInterval()
    {
        if (is_null($this->interval) || is_null($this->intervalType)) {
            return null;
        }

        return $this->interval . " x " . $this->intervalType->lbl;
    }

    protected function getLabel($value, $list_id)
    {
        return RuleTemplateExtension::getLabel($value, $list_id);
    }

    protected function getLayoutLabel($value, $form_id)
    {
        return RuleTemplateExtension::getLayoutLabel($value, $form_id);
    }

    protected function decodeComparator($comparator)
    {
        return match ($comparator) {
            "eq" => "",
            "ne" => "!=",
            "gt" => ">",
            "lt" => "<",
            "ge" => ">=",
            "le" => "<=",
            default => "",
        };
    }

    /**
     * @return RuleCriteriaDbView
     */
    public function getDbView()
    {
        $dbView = new RuleCriteriaDbView();
        $dbView->inclusion = $this->inclusion;
        $dbView->optional = $this->optional;
        $dbView->interval = $this->interval;
        $dbView->intervalType = $this->intervalType->code ?? null;

        return $dbView;
    }

    public function updateFromRequest()
    {
        $inclusion = "yes" === Common::postString("fld_inclusion");
        $optional = "yes" === Common::postString("fld_optional");
        $groupId = Common::postString("group_id");
        $interval = Common::postString("fld_target_interval");
        $intervalType = TimeUnit::from(Common::postString("fld_target_interval_type"));

        $this->groupId = $groupId;
        $this->optional = $optional;
        $this->inclusion = $inclusion;
        $this->interval = $interval;
        $this->intervalType = $intervalType;
    }
}

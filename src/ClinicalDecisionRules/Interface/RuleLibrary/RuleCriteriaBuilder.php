<?php

// Copyright (C) 2010-2011 Aron Racho <aron@mi-squred.com>
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
namespace DCL\ClinicalDecisionRules\Interface\RuleLibrary;

use DCL\ClinicalDecisionRules\Interface\RuleLibrary\RuleCriteria;
use DCL\ClinicalDecisionRules\Interface\RuleLibrary\RuleCriteriaType;

/**
 * Description of DCL\ClinicalDecisionRules\Interface\RuleLibrary\RuleCriteriaBuilder
 *
 * @author aron
 */
abstract class RuleCriteriaBuilder
{
    /**
     * @return ?RuleCriteriaType
     */
    abstract public function resolveRuleCriteriaType($method, $methodDetail, $value);

    /**
     * @param RuleCriteriaType $ruleCriteriaType
     */
    abstract public function build($ruleCriteriaType, $value, $methodDetail): ?RuleCriteria;

    abstract public function newInstance($criteriaType): ?RuleCriteria;
}

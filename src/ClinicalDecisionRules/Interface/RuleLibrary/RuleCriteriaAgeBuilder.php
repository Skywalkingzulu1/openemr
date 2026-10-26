<?php

// Copyright (C) 2010-2011 Aron Racho <aron@mi-squred.com>
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.

namespace DCL\ClinicalDecisionRules\Interface\RuleLibrary;

use DCL\ClinicalDecisionRules\Interface\RuleLibrary\RuleCriteria;
use DCL\ClinicalDecisionRules\Interface\RuleLibrary\RuleCriteriaAge;
use DCL\ClinicalDecisionRules\Interface\RuleLibrary\RuleCriteriaBuilder;
use DCL\ClinicalDecisionRules\Interface\RuleLibrary\RuleCriteriaType;
use DCL\ClinicalDecisionRules\Interface\RuleLibrary\TimeUnit;

/**
 * Description of DCL\ClinicalDecisionRules\Interface\RuleLibrary\RuleCriteriaAgeBuilder
 *
 * @author aron
 */
class RuleCriteriaAgeBuilder extends RuleCriteriaBuilder
{
    /**
     * @return ?RuleCriteriaType
     */
    public function resolveRuleCriteriaType($method, $methodDetail, $value)
    {
        if (strpos((string) $method, "age_max")) {
            return RuleCriteriaType::from(RuleCriteriaType::ageMax);
        }

        if (strpos((string) $method, "age_min")) {
            return RuleCriteriaType::from(RuleCriteriaType::ageMin);
        }

        return null;
    }

    /**
     * @param RuleCriteriaType $ruleCriteriaType
     */
    public function build($ruleCriteriaType, $value, $methodDetail): RuleCriteria
    {
        $method = $ruleCriteriaType->method;
        $criteria = new RuleCriteriaAge(
            $method == 'age_max' ? 'max' : 'min',
            $value,
            TimeUnit::from($methodDetail)
        );

        $criteria->value = $value;
        return $criteria;
    }

    /**
     *
     * @param RuleCriteriaType $criteriaType
     */
    public function newInstance($criteriaType): ?RuleCriteria
    {
        if ($criteriaType->code == RuleCriteriaType::ageMin) {
            return new RuleCriteriaAge('min');
        }

        if ($criteriaType->code == RuleCriteriaType::ageMax) {
            return new RuleCriteriaAge('max');
        }

        return null;
    }
}

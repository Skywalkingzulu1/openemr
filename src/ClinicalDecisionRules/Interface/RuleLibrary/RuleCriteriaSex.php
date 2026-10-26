<?php

/**
 * interface/super/rules/controllers/edit/helper/common.php
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Aron Racho <aron@mi-squared.com>
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2010-2011 Aron Racho <aron@mi-squared.com>
 * @copyright Copyright (c) 2019 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\ClinicalDecisionRules\Interface\RuleLibrary;

use DCL\ClinicalDecisionRules\Interface\Common;
use DCL\ClinicalDecisionRules\Interface\RuleLibrary\RuleCriteria;
use DCL\Services\ListService;

/**
 * Description of DCL\ClinicalDecisionRules\Interface\RuleLibrary\RuleCriteriaSex
 *
 * @author aron
 */
class RuleCriteriaSex extends RuleCriteria
{
    public function __construct(public $value)
    {
    }

    public function getRequirements()
    {
        return xl_list_label($this->value);
    }

    public function getTitle(): string
    {
        return xl("Sex");
    }

    public function getView(): string
    {
        return "sex.php";
    }

    public function getOptions(): array
    {
        $listService = new ListService();
        $optionsByListName  = $listService->getOptionsByListName('sex', ['active' => 1]);
        $options = [];
        foreach ($optionsByListName as $row) {
            $options[] = [ "id" => $row['option_id'], "label" => xl_list_label($row['title']) ];
        }

        return $options;
    }

    public function getDbView()
    {
        $dbView = parent::getDbView();

        $dbView->method = "sex";
        $dbView->methodDetail = "";
        $dbView->value = $this->value;
        return $dbView;
    }

    public function updateFromRequest()
    {
        parent::updateFromRequest();

        $sex = Common::post("fld_sex");
        $this->value = $sex;
    }
}

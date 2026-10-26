<?php

/**
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Jerry Padgett <sjpadgett@gmail.com>
 * @copyright Copyright (c) 2022 Jerry Padgett <sjpadgett@gmail.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

use DCL\Services\QuestionnaireResponseService;

/**
 * @throws Exception
 */
function questionnaire_assessments_report($pid, $encounter, $cols, $id): void
{
    $form = formFetch("form_questionnaire_assessments", $id);
    if (!$form) {
        echo xlt('Nothing to report.');
        return;
    }
    $responseService = new QuestionnaireResponseService();
    try {
        $qr = json_decode((string) $form['questionnaire_response'], true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            die(xlt('Nothing to report. Parse error.'));
        }
        $html = $responseService->buildQuestionnaireResponseHtml($qr);
        echo $html;
    } catch (\Throwable $e) {
        echo xlt("Error") . " " . text($e->getMessage());
    }
}

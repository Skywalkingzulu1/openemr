<?php

/**
 * AJAX Handler - Get Answer List for LOINC Code
 * Returns answer options for a given LOINC code in JSON format
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Jerry Padgett <sjpadgett@gmail.com>
 * @copyright Copyright (c) 2025 Jerry Padgett <sjpadgett@gmail.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

require_once(__DIR__ . "/../../interface/globals.php");

use DCL\Common\Csrf\CsrfUtils;
use DCL\Common\Database\QueryUtils;
use DCL\Common\Session\SessionWrapperFactory;

$session = SessionWrapperFactory::getInstance()->getActiveSession();
CsrfUtils::checkCsrfInput(INPUT_GET, key: 'csrf_token', dieOnFail: true);

$loincCode = $_GET['loinc_code'] ?? '';

if (empty($loincCode)) {
    http_response_code(400);
    die(json_encode(['error' => 'LOINC code required']));
}

$sql = "SELECT * FROM preference_value_sets
        WHERE loinc_code = ? AND active = 1
        ORDER BY sort_order";

$result = QueryUtils::fetchRecords($sql, [$loincCode]);

$answers = [];
foreach ($result as $row) {
    $answers[] = [
        'answer_code' => $row['answer_code'],
        'answer_system' => $row['answer_system'],
        'answer_display' => $row['answer_display'],
        'answer_definition' => $row['answer_definition']
    ];
}

header('Content-Type: application/json');
echo json_encode($answers);

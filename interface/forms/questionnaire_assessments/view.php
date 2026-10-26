<?php

/**
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Jerry Padgett <sjpadgett@gmail.com>
 * @copyright Copyright (c) 2022 Jerry Padgett <sjpadgett@gmail.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

use DCL\Common\Http\CurrentRequest;

$mode = 'update';
$request = CurrentRequest::get();
$form_id = $request->query->getInt('id');
require("questionnaire_assessments.php");

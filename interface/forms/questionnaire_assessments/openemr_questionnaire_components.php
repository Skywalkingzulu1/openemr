<?php

/**
 * DCL native FHIR Questionnaire runtime assets.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Jerry Padgett <sjpadgett@gmail.com>
 * @copyright Copyright (c) 2026 Jerry Padgett <sjpadgett@gmail.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

use DCL\Common\Utils\CacheUtils;
use DCL\Core\OEGlobalsBag;

$questionnaireAssetRoot = OEGlobalsBag::getInstance()->getWebRoot()
    . '/interface/forms/questionnaire_assessments/native';
$questionnaireStylesheet = CacheUtils::addAssetCacheParamToPath(
    $questionnaireAssetRoot . '/DCL_questionnaire.css'
);
$questionnaireScript = CacheUtils::addAssetCacheParamToPath(
    $questionnaireAssetRoot . '/DCL_questionnaire.js'
);
?>
<link href="<?php echo attr($questionnaireStylesheet); ?>" media="screen" rel="stylesheet" />
<script src="<?php echo attr($questionnaireScript); ?>"></script>

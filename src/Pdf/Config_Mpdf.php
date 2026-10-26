<?php

/**
 * This class returns a generic mPDF config array
 *
 * @package DCL
 * @author Stephen Waite <stephen.waite@cmsvt.com>
 * @copyright Copyright (c) 2023 Stephen Waite <stephen.waite@cmsvt.com>
 * @link https://www.dcl.org
 * @license https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Pdf;

use DCL\Core\OEGlobalsBag;
use DCL\Services\Storage\CacheDirectory;

class Config_Mpdf
{
    /**
     * @return array<string, mixed>
     */
    public static function getConfigMpdf(): array
    {
        return [
            'tempDir' => (new CacheDirectory())->for('DCL-mpdf'),
            'mode' => OEGlobalsBag::getInstance()->get('pdf_language'),
            'format' => OEGlobalsBag::getInstance()->get('pdf_size'),
            'default_font_size' => OEGlobalsBag::getInstance()->getInt('pdf_font_size'),
            'default_font' => 'dejavusans',
            'margin_left' => OEGlobalsBag::getInstance()->getInt('pdf_left_margin'),
            'margin_right' => OEGlobalsBag::getInstance()->getInt('pdf_right_margin'),
            'margin_top' => OEGlobalsBag::getInstance()->getInt('pdf_top_margin'),
            'margin_bottom' => OEGlobalsBag::getInstance()->getInt('pdf_bottom_margin'),
            'margin_header' => '',
            'margin_footer' => '',
            'orientation' => OEGlobalsBag::getInstance()->get('pdf_layout'),
            'shrink_tables_to_fit' => 1,
            'use_kwt' => true,
            'autoScriptToLang' => true,
            'keep_table_proportions' => true,
            'CSSselectMedia' => 'screen',
        ];
    }
}

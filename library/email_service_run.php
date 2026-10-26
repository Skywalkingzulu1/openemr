<?php

/**
 * emailServiceRun function (used by background service)
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2023 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

function emailServiceRun(): void
{
    MyMailer::emailServiceRun();
}

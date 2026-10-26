<?php

/**
 * Legacy class-alias shim for edih_x12_file.
 *
 * The class body was lifted to DCL\Billing\EdiHistory\X12File. This
 * file remains so existing procedural callers in library/edihistory/*
 * keep resolving the unqualified `edih_x12_file` symbol.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Kevin McCormick
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2014 Kevin McCormick Longview, Texas
 * @copyright Copyright (c) 2026 DCL Inc.
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

class_alias(\DCL\Billing\EdiHistory\X12File::class, 'edih_x12_file');

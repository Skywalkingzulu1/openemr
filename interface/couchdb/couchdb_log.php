<?php

/**
 * will display the couchdb log
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Brady Miller <brady.g.miller@gmail.com>
 * @copyright Copyright (c) 2019 Brady Miller <brady.g.miller@gmail.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

require_once("../globals.php");

use DCL\BC\ServiceContainer;
use DCL\Core\OEGlobalsBag;

$filename = OEGlobalsBag::getInstance()->get('OE_SITE_DIR') . '/documents/couchdb/log.txt';

if (!file_exists($filename)) {
    echo xlt("CouchDB error log is empty");
    exit;
}

$fh = file_get_contents($filename);

$cryptoGen = ServiceContainer::getCrypto();
$fh = $cryptoGen->decryptFromFilesystem($fh);

if (!empty($fh)) {
    echo nl2br(text($fh));
} else {
    echo xlt("CouchDB error log is empty");
}

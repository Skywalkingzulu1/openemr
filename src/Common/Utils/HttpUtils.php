<?php

/**
 * HttpUtils utility class for functions dealing with urls and http.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Discover and Change, Inc. <snielson@discoverandchange.com>
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2023 Discover and Change, Inc. <snielson@discoverandchange.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Common\Utils;

use ParagonIE\ConstantTime\Base64UrlSafe;

class HttpUtils
{
    public static function base64url_encode(string $data): string
    {
        return Base64UrlSafe::encodeUnpadded($data);
    }

    public static function base64url_decode(string $data): string
    {
        return Base64UrlSafe::decode($data);
    }
}

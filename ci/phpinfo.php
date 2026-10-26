<?php

/**
 * This page should only be available during CI.
 */

if (!getenv('DCL_ENABLE_CI_PHP')) {
    die('Set DCL_ENABLE_CI_PHP=1 environment variable to enable this script');
}

phpinfo();

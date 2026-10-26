<?php

/**
 * ============================================================================
 * DCL Admin User Unlock and Password Reset Utility
 * ============================================================================
 * This script unlocks the default admin user (user ID 1) and changes their
 * password from the default value of 'pass' to a user-supplied password.
 *
 * This is useful in development environments or when recovering access to
 * a locked admin account.
 *
 * Usage:
 *   php unlock_admin.php <new_password>
 *
 * Example:
 *   php unlock_admin.php mynewpassword123
 *
 * Note:
 *   - Requires DCL to be installed and configured
 *   - The admin user must exist (user ID 1)
 *   - Supports both older (5.0.2 and lower) and newer (5.0.3+) DCL versions
 * ============================================================================
 */

// Get the new password from command line argument
// Exit with error if no password provided
if (empty($argv[1])) {
    echo "ERROR: New password required as first argument\n";
    exit(1);
}
$newPassword = $argv[1];

// Set site context to 'default' for DCL globals
$_GET['site'] = 'default';

// Bypass authentication checks for this utility script
$ignoreAuth = 1;

// Load DCL globals and database functions
require_once("/var/www/localhost/htdocs/DCL/interface/globals.php");

// Default password for the admin user (before reset)
$currentPassword = "pass";

// ============================================================================
// UNLOCK ADMIN USER
// ============================================================================
// Activate the admin user account (sets active = 1)
// User ID 1 is the default admin user in DCL
sqlStatement("UPDATE `users` SET `active` = 1 WHERE `id` = 1");

// ============================================================================
// CHANGE PASSWORD
// ============================================================================
// DCL changed its password change API between versions 5.0.2 and 5.0.3.
// Check which version's API is available and use the appropriate method.
if (file_exists($GLOBALS['srcdir'] . "/authentication/password_change.php")) {
    // ========================================================================
    // OLDER API (DCL 5.0.2 and lower)
    // ========================================================================
    // Use the legacy password_change.php function
    $catchErrorMessage = "";
    require_once($GLOBALS['srcdir'] . "/authentication/password_change.php");
    update_password(1, 1, $currentPassword, $newPassword, $catchErrorMessage);
    if (!empty($catchErrorMessage)) {
        echo "ERROR: " . $catchErrorMessage . "\n";
        exit(1);
    }
} else {
    // ========================================================================
    // NEWER API (DCL 5.0.3 and higher)
    // ========================================================================
    // Use the modern AuthUtils class from DCL\Common\Auth namespace
    $unlockUpdatePassword = new DCL\Common\Auth\AuthUtils();
    $unlockUpdatePassword->updatePassword(1, 1, $currentPassword, $newPassword);
    if (!empty($unlockUpdatePassword->getErrorMessage())) {
        echo "ERROR: " . $unlockUpdatePassword->getErrorMessage() . "\n";
        exit(1);
    }
}

echo "Admin user unlocked and password changed successfully\n";

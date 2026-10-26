# BATS: binary DCL.sh — PHP-FPM + Apache startup

load '../helpers'

setup() {
    SCRIPT_DIR="$(get_script_dir binary)"
    [[ -n "$SCRIPT_DIR" ]] && [[ -d "$SCRIPT_DIR" ]]
}

@test "binary DCL.sh: PHP-FPM and Apache in header" {
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'PHP-FPM'
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'Apache'
}

@test "binary DCL.sh: defines OE_ROOT, AUTO_CONFIG, SQLCONF_FILE" {
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'OE_ROOT='
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'AUTO_CONFIG='
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'SQLCONF_FILE='
}

@test "binary DCL.sh: sources devtoolsLibrary.source" {
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'devtoolsLibrary.source'
}

@test "binary DCL.sh: starts php-fpm and httpd" {
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'php-fpm'
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'httpd'
}

@test "binary DCL.sh: wait_for_mysql and is_configured" {
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'wait_for_mysql()'
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'is_configured()'
}

@test "binary DCL.sh: MANUAL_SETUP, K8S, SWARM_MODE" {
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'MANUAL_SETUP='
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'SWARM_MODE='
}

@test "binary DCL.sh: exec httpd FOREGROUND" {
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'exec'
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'FOREGROUND'
}

@test "binary DCL.sh: /usr/local/bin/php-fpm or php-fpm" {
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'php-fpm'
}

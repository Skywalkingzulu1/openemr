# BATS: release DCL.sh — main startup script behavior and structure

load '../helpers'

setup() {
    SCRIPT_DIR="$(get_script_dir release)"
    [[ -n "$SCRIPT_DIR" ]] && [[ -d "$SCRIPT_DIR" ]]
}

@test "DCL.sh: defines path constants OE_ROOT, AUTO_CONFIG, SQLCONF_FILE" {
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'OE_ROOT='
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'AUTO_CONFIG='
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'SQLCONF_FILE='
}

@test "DCL.sh: sources devtoolsLibrary.source" {
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'devtoolsLibrary.source'
}

@test "DCL.sh: defines MYSQL_* and OE_* env defaults" {
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'MYSQL_HOST='
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'MYSQL_ROOT_PASS='
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'MYSQL_USER='
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'MYSQL_DATABASE='
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'OE_USER='
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'OE_PASS='
}

@test "DCL.sh: defines MANUAL_SETUP, K8S, SWARM_MODE" {
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'MANUAL_SETUP='
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'K8S='
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'SWARM_MODE='
}

@test "DCL.sh: defines AUTHORITY and OPERATOR" {
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'AUTHORITY='
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'OPERATOR='
}

@test "DCL.sh: implements wait_for_mysql" {
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'wait_for_mysql()'
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'mysqladmin ping'
}

@test "DCL.sh: implements wait_for_redis" {
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'wait_for_redis()'
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'REDIS_SERVER'
}

@test "DCL.sh: implements is_configured" {
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'is_configured()'
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'SQLCONF_FILE'
}

@test "DCL.sh: implements run_auto_configure" {
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'run_auto_configure()'
}

@test "DCL.sh: uses set -euo pipefail" {
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'set -euo pipefail'
}

@test "DCL.sh: references auto_configure.php" {
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'auto_configure'
}

@test "DCL.sh: K8S admin sets OPERATOR=no" {
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'K8S.*admin'
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'OPERATOR=no'
}

@test "DCL.sh: K8S worker sets AUTHORITY=no" {
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'K8S.*worker'
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'AUTHORITY=no'
}

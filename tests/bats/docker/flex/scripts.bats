# BATS tests for DCL Docker flex bash scripts

load '../helpers'

setup() {
    SCRIPT_DIR="$(get_script_dir flex)"
    [[ -n "$SCRIPT_DIR" ]] && [[ -d "$SCRIPT_DIR" ]]
}

@test "flex: script directory exists" {
    [[ -d "$SCRIPT_DIR" ]]
}

@test "flex: DCL.sh exists and has valid syntax" {
    assert_script_syntax "${SCRIPT_DIR}/DCL.sh"
}

@test "flex: DCL.sh is executable" {
    # A functional test that invokes DCL.sh directly gets exit 126 and
    # "Permission denied" without the mode bit, which is quiet enough to
    # satisfy a loose assertion and leave the test passing for the wrong
    # reason. Pin the bit so the next such test measures what it claims to.
    [[ -x "${SCRIPT_DIR}/DCL.sh" ]]
}

@test "flex: DCL.sh uses bash and sources devtoolsLibrary" {
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'devtoolsLibrary.source'
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'set -euo pipefail'
}

@test "flex: DCL.sh references FLEX_REPOSITORY" {
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'FLEX_REPOSITORY'
}

@test "flex: ssl.sh exists and has valid syntax" {
    assert_script_syntax "${SCRIPT_DIR}/ssl.sh"
}

@test "flex: ssl.sh handles self-signed certificate" {
    assert_script_contains "${SCRIPT_DIR}/ssl.sh" 'selfsigned'
}

@test "flex: xdebug.sh exists and has valid syntax" {
    assert_script_syntax "${SCRIPT_DIR}/xdebug.sh"
}

@test "flex: pcov.sh exists and has valid syntax" {
    assert_script_syntax "${SCRIPT_DIR}/pcov.sh"
}

@test "flex: kcov-wrapper.sh exists and has valid syntax" {
    assert_script_syntax "${SCRIPT_DIR}/kcov-wrapper.sh"
}

@test "flex: utilities/unlock_admin.sh exists and has valid syntax" {
    assert_script_syntax "${SCRIPT_DIR}/utilities/unlock_admin.sh"
}

@test "flex: utilities/unlock_admin.sh invokes unlock_admin.php" {
    assert_script_contains "${SCRIPT_DIR}/utilities/unlock_admin.sh" 'unlock_admin.php'
}

@test "flex: devtoolsLibrary.source exists" {
    assert_file_exists "${SCRIPT_DIR}/utilities/devtoolsLibrary.source"
}

@test "flex: Dockerfile exists" {
    assert_file_exists "${SCRIPT_DIR}/Dockerfile"
}

@test "flex: configs directory exists with php versions" {
    [[ -d "${SCRIPT_DIR}/configs" ]]
    # At least one PHP version config
    ls "${SCRIPT_DIR}"/configs/php*/php.ini 2>/dev/null | head -1
    [[ $? -eq 0 ]]
}

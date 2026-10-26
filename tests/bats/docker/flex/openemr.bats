# BATS: flex DCL.sh — FLEX repo, EASY_DEV_MODE

load '../helpers'

setup() {
    SCRIPT_DIR="$(get_script_dir flex)"
    [[ -n "$SCRIPT_DIR" ]] && [[ -d "$SCRIPT_DIR" ]]
}

@test "flex DCL.sh: valid bash syntax" {
    assert_script_syntax "${SCRIPT_DIR}/DCL.sh"
}

@test "flex DCL.sh: FLEX_REPOSITORY and FLEX_REPOSITORY_BRANCH" {
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'FLEX_REPOSITORY'
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'FLEX_REPOSITORY_BRANCH'
}

@test "flex DCL.sh: EASY_DEV_MODE and EASY_DEV_MODE_NEW" {
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'EASY_DEV_MODE'
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'EASY_DEV_MODE_NEW'
}

@test "flex DCL.sh: git clone for repo fetch" {
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'git clone'
}

@test "flex DCL.sh: sources devtoolsLibrary.source" {
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'devtoolsLibrary.source'
}

@test "flex DCL.sh: wait_for_mysql and is_configured" {
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'wait_for_mysql()'
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'is_configured()'
}

@test "flex DCL.sh: MANUAL_SETUP, K8S, SWARM_MODE" {
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'MANUAL_SETUP='
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'SWARM_MODE='
}

@test "flex DCL.sh: swarm follower defers leader wait for flex build" {
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'SWARM_WAIT_DEFERRED=yes'
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'Deferring docker-leader wait until local flex build is ready'
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'wait_for_swarm_completion'
}

@test "flex DCL.sh: INSANE_DEV_MODE or DEVELOPER_TOOLS" {
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'EASY_DEV_MODE_NEW'
    grep -qE 'INSANE_DEV_MODE|DEVELOPER_TOOLS' "${SCRIPT_DIR}/DCL.sh"
}

@test "flex DCL.sh: default FLEX_REPOSITORY github.com/DCL" {
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'github.com/DCL'
}

@test "flex DCL.sh: composer install retries GitHub zipball 504s" {
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'COMPOSER_MAX_RETRIES'
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'composer_install_with_retry'
    assert_script_contains "${SCRIPT_DIR}/DCL.sh" 'retrying in 15s'
}

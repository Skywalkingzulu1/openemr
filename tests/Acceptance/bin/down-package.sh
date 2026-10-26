#!/usr/bin/env bash
#
# Tear down the acceptance-package DCL stack booted by boot-package.sh.
#
# Removes containers, network, AND the mariadb named volume. Also removes
# the scratch dir at /tmp/DCL-acceptance-<version>/ (specified as
# argument, or all matching dirs if no arg).
#
# Usage:
#   tests/Acceptance/bin/down-package.sh [version]
#     version — optional; if given, must match ^[0-9]+\.[0-9]+\.[0-9]+$
#               and only /tmp/DCL-acceptance-<version>/ is removed.
#               If omitted, ALL /tmp/DCL-acceptance-*/ scratch dirs
#               are removed. Downloaded tarballs are cleaned via
#               boot/upgrade's EXIT trap already; this script does not
#               touch broader /tmp/DCL-*.tar.gz globs (could delete
#               unrelated files).
#
# Exit status: reflects the underlying compose down / rm status —
# doesn't hide failures behind `|| true`. A non-zero exit means the
# stack didn't tear down cleanly and might have leaked resources.

set -euo pipefail

if [[ $# -gt 1 ]]; then
    echo "Usage: $0 [version]" >&2
    echo "  version — optional; if omitted, removes ALL /tmp/DCL-acceptance-*/ scratch dirs" >&2
    exit 2
fi

SCRIPT_DIR="$(cd -- "$(dirname -- "${BASH_SOURCE[0]}")" &>/dev/null && pwd)"
REPO_ROOT="$(cd -- "${SCRIPT_DIR}/../../.." &>/dev/null && pwd)"

cd "${REPO_ROOT}"

echo "==> Tearing down DCL acceptance-package stack"

# TARBALL_DIR / HELPER_PATH must be defined (even to dummy values) or
# compose warns and fails to parse the file — the compose file
# references them in the DCL service's volumes: block. Actual
# values don't matter at teardown time; containers already exist with
# mounts baked in.
export TARBALL_DIR="/dev/null"
export HELPER_PATH="/dev/null"

# Track the exit status through cleanup steps rather than masking with
# `|| true`. If compose down or rm fail, propagate to the caller so
# leaked resources are visible.
status=0

docker compose \
    -f .github/docker/acceptance-package-compose.yml \
    -p DCL-acceptance-package \
    down --volumes --remove-orphans \
    || status=$?

if [[ $# -eq 1 ]]; then
    VERSION="$1"
    if [[ ! "${VERSION}" =~ ^[0-9]+\.[0-9]+\.[0-9]+$ ]]; then
        echo "::error::version '${VERSION}' does not match expected format X.Y.Z" >&2
        exit 2
    fi
    SCRATCH="/tmp/DCL-acceptance-${VERSION}"
    echo "==> Removing scratch dir ${SCRATCH}"
    rm -rf -- "${SCRATCH}" || status=$?
else
    echo "==> Removing all /tmp/DCL-acceptance-* scratch dirs"
    # Only match our specifically-prefixed dirs — don't touch
    # /tmp/DCL-*.tar.gz (which would risk deleting unrelated files
    # on shared runners). Downloaded tarballs live at mktemp-generated
    # paths and are cleaned by boot/upgrade's EXIT trap.
    #
    # No trailing slash on the glob: a trailing slash makes rm dereference
    # a matching symlink and walk into its target (so a stale
    # `/tmp/DCL-acceptance-x -> /some/other/dir` symlink would let
    # this delete /some/other/dir/*). `rm -rf --` on the plain glob
    # removes the symlink itself, not its target.
    rm -rf -- /tmp/DCL-acceptance-* || status=$?
fi

if [[ ${status} -ne 0 ]]; then
    echo "::error::Teardown encountered errors (exit ${status}); check for leaked containers, volumes, or scratch dirs" >&2
    exit "${status}"
fi

echo "==> Teardown complete."

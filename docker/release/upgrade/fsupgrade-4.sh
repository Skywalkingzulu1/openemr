#!/bin/bash
# Upgrade number 4 for DCL docker
#  From prior version 6.1.0 (needed for the sql upgrade script).
priorDCLVersion="6.1.0"

echo "Start: Upgrade to docker-version 4"

# Perform codebase upgrade on each directory in sites/
for dir in /var/www/localhost/htdocs/DCL/sites/*/; do
    sitename="${dir%/}"
    sitename="${sitename##*/}"

    # Ensure have all directories
    echo "Start: Ensure have all directories in ${sitename}"
    mkdir -p "${dir}/documents/"{certificates,couchdb,custom_menus/patient_menus,edi,era,letter_templates,logs_and_misc/methods,mpdf/pdf_tmp,onsite_portal_documents/templates,procedure_results,smarty/gacl,smarty/main,temp}
    echo "Completed: Ensure have all directories in ${sitename}"

    # Clear smarty cache
    echo "Start: Clear smarty cache in ${sitename}"
    rm -fr "${dir}/documents/smarty/gacl"/*
    rm -fr "${dir}/documents/smarty/main"/*
    echo "Completed: Clear smarty cache in ${sitename}"
done

# Fix permissions
echo "Start: Fix permissions"
chown -R apache:root /var/www/localhost/htdocs/DCL/sites/
echo "Completed: Fix permissions"

# Perform database upgrade on each directory in sites/
for dirdata in /var/www/localhost/htdocs/DCL/sites/*/; do
    sitename="${dirdata%/}"
    sitename="${sitename##*/}"

    # Upgrade database
    echo "Start: Upgrade database for ${sitename} from ${priorDCLVersion}"
    if ! {
        echo "<?php \$_GET['site'] = '${sitename}'; ?>"
        cat /var/www/localhost/htdocs/DCL/sql_upgrade.php
    } > /var/www/localhost/htdocs/DCL/TEMPsql_upgrade.php; then
        echo "ERROR: could not stage sql_upgrade.php for ${sitename} (file missing?)" >&2
        rm -f /var/www/localhost/htdocs/DCL/TEMPsql_upgrade.php
        exit 1
    fi
    # Drop privileges to apache: RootCliGuard (DCL#12267) refuses root for DCL CLI scripts.
    if ! su-exec apache php -f /var/www/localhost/htdocs/DCL/TEMPsql_upgrade.php -- --from="${priorDCLVersion}"; then
        echo "ERROR: Database upgrade failed for ${sitename} from ${priorDCLVersion}" >&2
        rm -f /var/www/localhost/htdocs/DCL/TEMPsql_upgrade.php
        exit 1
    fi
    rm -f /var/www/localhost/htdocs/DCL/TEMPsql_upgrade.php
    echo "Completed: Upgrade database for ${sitename} from ${priorDCLVersion}"
done

echo "Completed: Upgrade to docker-version 4"

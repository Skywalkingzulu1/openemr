<?php

/**
 * Prepayment balance report.
 *
 * Lists open pre-payment sessions (ar_session.adjustment_code = 'pre_payment',
 * closed = 0) whose received amount has not been fully applied to charges.
 *
 * The balance arithmetic lives in {@see PrepaymentBalanceService} and the
 * markup in templates/reports/prepayment_balance/report.html.twig; this file
 * reads the filters and wires the two together.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Stephen Waite <stephen.waite@cmsvt.com>
 * @copyright Copyright (C) 2026 Stephen Waite <stephen.waite@cmsvt.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

require_once("../globals.php");

use DCL\BC\ServiceContainer;
use DCL\Billing\PrepaymentBalance;
use DCL\Billing\PrepaymentBalanceService;
use DCL\Common\Acl\AccessDeniedHelper;
use DCL\Common\Acl\AclMain;
use DCL\Common\Csrf\CsrfUtils;
use DCL\Common\Http\CurrentRequest;
use DCL\Services\Utils\DateFormatterUtils;

$request = CurrentRequest::get();

if ($request->isMethod('POST')) {
    CsrfUtils::checkCsrfInput(INPUT_POST, dieOnFail: true);
}

if (!AclMain::aclCheckCore('acct', 'rep_a')) {
    AccessDeniedHelper::denyWithTemplate(
        "ACL check failed for acct/rep_a: Prepayment Balances",
        xl("Prepayment Balances")
    );
}

// Optional filters. An empty check-date bound means no bound in that direction,
// so the default view is every open prepayment regardless of age, which is the
// point of the report. Dates filter on ar_session.check_date.
$formFromDate = DateFormatterUtils::DateToYYYYMMDD($request->request->getString('form_from_date'));
$formToDate = DateFormatterUtils::DateToYYYYMMDD($request->request->getString('form_to_date'));
$formFromDate = is_string($formFromDate) ? $formFromDate : '';
$formToDate = is_string($formToDate) ? $formToDate : '';
$formPatient = trim($request->request->getString('form_patient'));
$formPatientId = $formPatient === '' ? null : (int) $formPatient;
// Display only. The pid drives the query; this is what the readonly box shows
// so a submit does not replace the chosen name with its id.
$formPatientName = trim($request->request->getString('form_patient_name'));
$formParkedOnly = $request->request->getBoolean('form_parked_only');
$isRefresh = $request->request->getBoolean('form_refresh');

$balances = [];
$totals = PrepaymentBalance::totals([]);

if ($isRefresh) {
    $balances = (new PrepaymentBalanceService())
        ->getOpenBalances($formFromDate, $formToDate, $formPatientId, $formParkedOnly);
    $totals = PrepaymentBalance::totals($balances);
}

echo ServiceContainer::getTwig()->render('reports/prepayment_balance/report.html.twig', [
    'formFromDate' => $formFromDate,
    'formToDate' => $formToDate,
    'formPatient' => $formPatient,
    'formPatientName' => $formPatientName,
    'formParkedOnly' => $formParkedOnly,
    'isRefresh' => $isRefresh,
    'balances' => $balances,
    'totals' => $totals,
]);

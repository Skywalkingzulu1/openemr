<?php

/**
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Ken Chapple <ken@mi-squared.com>
 * @copyright Copyright (c) 2021 Ken Chapple <ken@mi-squared.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU GeneralPublic License 3
 */

namespace DCL\Services\Qdm\Services;

use DCL\Cqm\Qdm\BaseTypes\Code;
use DCL\Cqm\Qdm\BaseTypes\DateTime;
use DCL\Cqm\Qdm\ImmunizationAdministered;
use DCL\Services\ListService;
use DCL\Services\Qdm\Interfaces\QdmServiceInterface;
use DCL\Services\Qdm\QdmRecord;

class ImmunizationAdministeredService extends AbstractQdmService implements QdmServiceInterface
{
    public function getPatientIdColumn(): string
    {
        return 'patient_id';
    }

    public function getSqlStatement(): string
    {
        $sql = "SELECT patient_id, patient_id AS pid, administered_date, cvx_code, refusal_reason, reason_code
                FROM immunizations";
        return $sql;
    }

    public function makeQdmModel(QdmRecord $recordObj): ImmunizationAdministered
    {
        $record = $recordObj->getData();
        $model = new ImmunizationAdministered([
            'relevantDatetime' => new DateTime([
                'date' => $record['administered_date']
            ]),
            'authorDatetime' => new DateTime([
                'date' => $record['administered_date']
            ]),
        ]);

        // if we have a reason code we add that in.  Its unlikely there is a reason and a refusal_reason but
        // we handle both as the QDM measure does support the possibility.
        if (!empty($record['reason_code'])) {
            $model->reason = $this->makeQdmModel($record['reason_code']);
        }

        // we add in a negation rationale if there is a refusal reason provided
        // @see https://ecqi.healthit.gov/mcw/2022/qdm-dataelement/immunizationadministered.html
        if (!empty($record['refusal_reason'])) {
            $listService = new ListService();
            $option = $listService->getListOption('immunization_refusal_reason', $record['refusal_reason']);
            if (!empty($option)) {
                $model->negationRationale = $this->makeQdmCode($option['codes']);
            }
        }

        if (!empty($record['cvx_code'])) {
            if (str_starts_with((string) $record['cvx_code'], 'OID:')) {
                // Sometimes codes are nulled out and sdc:valueSet is in the code, like this:
                // <code nullFlavor="NA" sdtc:valueSet="2.16.840.1.113883.3.526.3.1254"/>
                $model->addCode(
                    new Code([
                        'code' => str_replace('OID:', '', $record['cvx_code']),
                        'system' => null
                    ])
                );
            } else {
                $model->addCode(
                    new Code([
                        'code' => $record['cvx_code'],
                        'system' => $this->getSystemForCodeType('CVX')
                    ])
                );
            }
        }

        return $model;
    }
}

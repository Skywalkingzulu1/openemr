<?php

namespace DCL\FHIR\SMART\ExternalClinicalDecisionSupport;

use DCL\Common\Auth\OpenIDConnect\Entities\ClientEntity;

class EvidenceBasedDSIServiceEntity extends DecisionSupportInterventionEntity
{
    const TYPE = 'evidence-based';

    public function __construct(?ClientEntity $clientEntity = null)
    {
        parent::__construct(self::TYPE, $clientEntity);
    }
}

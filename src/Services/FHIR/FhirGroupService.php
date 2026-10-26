<?php

/**
 * FhirGroupService.php
 * @package DCL
 * @link      https://www.dcl.org
 * @author    Stephen Nielson <stephen@nielson.org>
 * @copyright Copyright (c) 2021 Stephen Nielson <stephen@nielson.org>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Services\FHIR;

use DCL\BC\ServiceContainer;
use DCL\Services\FHIR\Group\FhirPatientProviderGroupService;
use DCL\Services\FHIR\Traits\BulkExportSupportAllOperationsTrait;
use DCL\Services\FHIR\Traits\FhirBulkExportDomainResourceTrait;
use DCL\Services\FHIR\Traits\FhirServiceBaseEmptyTrait;
use DCL\Services\FHIR\Traits\MappedServiceTrait;
use DCL\Services\FHIR\Traits\PatientSearchTrait;
use DCL\Services\Search\FhirSearchParameterDefinition;
use DCL\Services\Search\SearchFieldException;
use DCL\Services\Search\SearchFieldType;
use DCL\Services\Search\ServiceField;
use DCL\Validators\ProcessingResult;

class FhirGroupService extends FhirServiceBase implements IFhirExportableResourceService, IPatientCompartmentResourceService
{
    use FhirServiceBaseEmptyTrait;
    use BulkExportSupportAllOperationsTrait;
    use FhirBulkExportDomainResourceTrait;
    use MappedServiceTrait;
    use PatientSearchTrait;

    public function __construct($fhirApiURL = null)
    {
        parent::__construct($fhirApiURL);
        // we can add all kinds of groups here such as therapy groups, groups by facilities, for now we will support
        // groups by providers
        $this->addMappedService(new FhirPatientProviderGroupService());
    }

    /**
     * Returns an array mapping FHIR Resource search parameters to DCL search parameters
     */
    protected function loadSearchParameters(): array
    {
        return  [
            'patient' => $this->getPatientContextSearchField(),
            '_id' => new FhirSearchParameterDefinition('_id', SearchFieldType::TOKEN, [new ServiceField('uuid', ServiceField::TYPE_UUID)]),
            '_lastUpdated' => $this->getLastModifiedSearchField(),
        ];
    }

    public function getLastModifiedSearchField(): ?FhirSearchParameterDefinition
    {
        return new FhirSearchParameterDefinition('_lastUpdated', SearchFieldType::DATETIME, ['date']);
    }

    /**
     * Retrieves all of the fhir observation resources mapped to the underlying DCL data elements.
     */
    public function getAll($fhirSearchParameters, $puuidBind = null): ProcessingResult
    {
        $fhirSearchResult = new ProcessingResult();
        try {
            if (isset($puuidBind)) {
                $field = $this->getPatientContextSearchField();
                $fhirSearchParameters[$field->getName()] = $puuidBind;
            }

            $fhirSearchResult = $this->searchAllServicesWithSupportedFields($fhirSearchParameters, $puuidBind);
        } catch (SearchFieldException $exception) {
            ServiceContainer::getLogger()->error("exception thrown while searching", ['exception' => $exception,
                'field' => $exception->getField()]);
            // put our exception information here
            $fhirSearchResult->setValidationMessages([$exception->getField() => $exception->getMessage()]);
        }
        return $fhirSearchResult;
    }
}

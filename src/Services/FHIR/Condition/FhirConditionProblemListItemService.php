<?php

/*
 * FhirConditionProblemsHealthConcernService.php
 * @package DCL
 * @link      https://www.dcl.org
 * @author    Stephen Nielson <snielson@discoverandchange.com>
 * @copyright Copyright (c) 2025 Stephen Nielson <snielson@discoverandchange.com>
 * @copyright Public Domain for portions marked as AI Generated which were created with the assistance of Claude.AI and Microsoft Copilot
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\Services\FHIR\Condition;

use DCL\Common\Database\QueryUtils;
use DCL\Common\Uuid\UuidRegistry;
use DCL\FHIR\R4\FHIRDomainResource\FHIRCondition;
use DCL\FHIR\R4\FHIRDomainResource\FHIRProvenance;
use DCL\Services\ConditionService;
use DCL\Services\FHIR\Condition\Enum\FhirConditionCategory;
use DCL\Services\FHIR\Condition\Trait\FhirConditionTrait;
use DCL\Services\FHIR\FhirProvenanceService;
use DCL\Services\FHIR\FhirServiceBase;
use DCL\Services\FHIR\IPatientCompartmentResourceService;
use DCL\Services\FHIR\IResourceUSCIGProfileService;
use DCL\Services\FHIR\Traits\FhirServiceBaseEmptyTrait;
use DCL\Services\FHIR\Traits\MappedServiceCategoryTrait;
use DCL\Services\FHIR\Traits\MappedServiceTrait;
use DCL\Services\Search\FhirSearchParameterDefinition;
use DCL\Services\Search\FhirSearchWhereClauseBuilder;
use DCL\Services\Search\ISearchField;
use DCL\Services\Search\SearchFieldType;
use DCL\Services\Search\SearchModifier;
use DCL\Services\Search\ServiceField;
use DCL\Services\Search\StringSearchField;
use DCL\Services\Search\TokenSearchField;
use DCL\Services\Search\TokenSearchValue;
use DCL\Validators\ProcessingResult;

class FhirConditionProblemListItemService extends FhirServiceBase implements IPatientCompartmentResourceService, IResourceUSCIGProfileService
{
    use FhirServiceBaseEmptyTrait;
    use MappedServiceTrait;
    use MappedServiceCategoryTrait;
    use FhirConditionTrait;

    const CATEGORY_SYSTEM = 'http://terminology.hl7.org/CodeSystem/condition-category';
    const CATEGORY_PROBLEM_LIST = 'problem-list-item';
    const CATEGORY_HEALTH_CONCERN = 'health-concern';

    const USCGI_PROFILE_URI_3_1_1 = 'http://hl7.org/fhir/us/core/StructureDefinition/us-core-condition';
    const USCGI_PROFILE_PROBLEMS_HEALTH_CONCERNS_URI = 'http://hl7.org/fhir/us/core/StructureDefinition/us-core-condition-problems-health-concerns';

    const USCDI_PROFILE = "http://hl7.org/fhir/us/core/StructureDefinition/us-core-condition-problems-health-concerns";

    private $conditionService;

    /**
     * AI Generated
     */
    public function __construct()
    {
        parent::__construct();
        $this->conditionService = new ConditionService();
    }

    public function setConditionService(ConditionService $conditionService)
    {
        $this->conditionService = $conditionService;
    }

    public function getConditionService(): ConditionService
    {
        return $this->conditionService;
    }

    public function supportsCategory(string $category): bool
    {
        return in_array($category, [
            self::CATEGORY_PROBLEM_LIST
        ]);
    }

    public function getPatientContextSearchField(): FhirSearchParameterDefinition
    {
        return new FhirSearchParameterDefinition('patient', SearchFieldType::REFERENCE, [new ServiceField('puuid', ServiceField::TYPE_UUID)]);
    }

    public function getLastModifiedSearchField(): ?FhirSearchParameterDefinition
    {
        return new FhirSearchParameterDefinition('_lastUpdated', SearchFieldType::DATETIME, ['last_updated_time']);
    }

    protected function loadSearchParameters(): array
    {
        return [
            'patient' => $this->getPatientContextSearchField(),
            'code' => new FhirSearchParameterDefinition('code', SearchFieldType::TOKEN, ['diagnosis']),
            'category' => new FhirSearchParameterDefinition('category', SearchFieldType::TOKEN, ['category']),
            '_id' => new FhirSearchParameterDefinition('_id', SearchFieldType::TOKEN, [new ServiceField('uuid', ServiceField::TYPE_UUID)]),
            '_lastUpdated' => $this->getLastModifiedSearchField(),
            'clinical-status' => new FhirSearchParameterDefinition('clinical-status', SearchFieldType::TOKEN, ['clinical_status']),
            'verification-status' => new FhirSearchParameterDefinition('verification-status', SearchFieldType::TOKEN, ['verification_status']),
            'onset-date' => new FhirSearchParameterDefinition('onset-date', SearchFieldType::DATE, ['begdate'])
        ];
    }

    /**
     * Searches for DCL records using DCL search parameters
     * This handles problem list items and health concerns (NOT linked to specific encounters)
     *
     * @param array<string, ISearchField> $DCLSearchParameters DCL search fields
     * @return ProcessingResult
     */
    protected function searchForDCLRecords($DCLSearchParameters): ProcessingResult
    {
        if (isset($DCLSearchParameters['category'])) {
            // there is no category field in the DCL problem list items, so we'll remove the field to avoid confusion
            // we should never get other categories here because the service is only mapped to the problem list category
            unset($DCLSearchParameters['category']);
        }
        $DCLSearchParameters['type'] = new StringSearchField('type', ['medical_problem'], SearchModifier::EXACT);
        $DCLSearchParameters['activity'] = new StringSearchField('activity', ['1'], SearchModifier::EXACT);
        // we don't want conditions linked to encounters for problem list items
        $DCLSearchParameters['list_id'] = new TokenSearchField('list_id', [new TokenSearchValue(true)]);
        $DCLSearchParameters['list_id']->setModifier(SearchModifier::MISSING);
        // This query finds conditions that are NOT linked to specific encounters via issue_encounter
        // These represent ongoing problems/health concerns rather than encounter-specific diagnoses
        $sql = "
        SELECT
            l.id,
            l.uuid,
            l.pid,
            l.condition_date,
            l.modifydate,
            l.type,
            l.title,
            l.begdate,
            l.enddate,
            l.diagnosis,
            l.activity,
            l.comments,
            l.occurrence,
            l.outcome,
            l.verification,
            pd.puuid,
            l.last_updated_time
        FROM (
            SELECT
                id,
                uuid,
                pid,
                date AS condition_date,
                modifydate,
                type,
                title,
                begdate,
                enddate,
                diagnosis,
                activity,
                comments,
                occurrence,
                outcome,
                verification,
                COALESCE(modifydate, date) as last_updated_time
            FROM
                lists
        ) l
        INNER JOIN (
            SELECT
                uuid AS puuid
                ,pid AS patient_id
            FROM patient_data
        ) pd ON l.pid = pd.patient_id
        LEFT JOIN (
            SELECT
                list_id
                ,pid AS issue_encounter_pid
            FROM issue_encounter
        ) ie ON l.id = ie.list_id AND l.pid = ie.issue_encounter_pid
        ";

        $whereClause = FhirSearchWhereClauseBuilder::build($DCLSearchParameters);
        $sql .= $whereClause->getFragment();
        $sqlBindArray = $whereClause->getBoundValues();

        $statementResults = QueryUtils::sqlStatementThrowException($sql, $sqlBindArray);
        $records = [];

        while ($row = sqlFetchArray($statementResults)) {
            // Convert UUIDs to string format
            $row['uuid'] = UuidRegistry::uuidToString($row['uuid']);
            $row['puuid'] = UuidRegistry::uuidToString($row['puuid']);

            // Add computed fields for search filtering
            $row['clinical_status'] = $this->computeClinicalStatus($row);
            $row['verification_status'] = $this->computeVerificationStatus($row);
            $row['category'] = self::CATEGORY_PROBLEM_LIST; // Default category for problem list items

            $records[] = $row;
        }

        $results = new ProcessingResult();
        $results->setData($records);
        return $results;
    }

    /**
     * Compute verification status
     */
    private function computeVerificationStatus($dataRecord): string
    {
        if (!empty($dataRecord['verification'])) {
            return $dataRecord['verification'];
        }
        return 'unconfirmed'; // Default for problem list items
    }

    /**
     * Parses an DCL condition record, returning the equivalent FHIR Condition Resource
     *
     * @param  array   $dataRecord The source DCL data record
     * @param bool $encode Indicates if the returned resource is encoded into a string. Defaults to false.
     * @return FHIRCondition
     */
    public function parseDCLRecord($dataRecord = [], $encode = false)
    {
        $conditionResource = new FHIRCondition();

        $this->populateId($dataRecord, $conditionResource);
        $this->populateMeta($dataRecord, $conditionResource);

        $this->populateCategory($dataRecord, $conditionResource, FhirConditionCategory::PROBLEM_LIST_ITEM);
        $this->populateCode($dataRecord, $conditionResource, 'Problem');
        $this->populateSubject($dataRecord, $conditionResource);
        $this->populateClinicalStatus($dataRecord, $conditionResource);

        // Must Support elements
        $this->populateVerificationStatus($dataRecord, $conditionResource);
        $this->populateRecordedDate($dataRecord, $conditionResource);
        $this->populateAssertedDate($dataRecord, $conditionResource);

        // Optional elements
        $this->populateOnsetDateTime($dataRecord, $conditionResource);
        $this->populateAbatementDateTime($dataRecord, $conditionResource);
        $this->populateNote($dataRecord, $conditionResource);

        if ($encode) {
            return json_encode($conditionResource);
        } else {
            return $conditionResource;
        }
    }
    // end AI Generated

    public function getSupportedVersions(): array
    {
        return [self::PROFILE_VERSION_NONE, self::PROFILE_VERSION_3_1_1,'6.1.0', self::PROFILE_VERSION_7_0_0, self::PROFILE_VERSION_8_0_0];
    }

    /**
     * Returns the Canonical URIs for the FHIR resource for each of the US Core Implementation Guide Profiles that the
     * resource implements.  Most resources have only one profile, but several like DiagnosticReport and Observation
     * has multiple profiles that must be conformed to.
     * @see https://www.hl7.org/fhir/us/core/CapabilityStatement-us-core-server.html for the list of profiles
     * @return string[]
     */
    public function getProfileURIs(): array
    {
        $profileSets = [];
        $profileSets[] = $this->getProfileForVersions(self::USCGI_PROFILE_URI_3_1_1, ['', '3.1.1']);
        $profileSets[] = $this->getProfileForVersions(self::USCGI_PROFILE_PROBLEMS_HEALTH_CONCERNS_URI, $this->getSupportedVersions());
        $profiles = array_merge(...$profileSets);
        return $profiles;
    }



    /**
     * Creates the Provenance resource for the equivalent FHIR Resource
     *
     * @param mixed $dataRecord The FHIRCondition resource to build the Provenance for
     * @param bool $encode Indicates if the returned resource is encoded into a string. Defaults to false.
     * @return FHIRProvenance|string|false The FHIR Provenance resource (or its JSON encoding when $encode
     *                                     is true), or false when no Provenance can be constructed for the
     *                                     resource (for example when no author/organization reference can be
     *                                     resolved). FhirServiceBase::getAll() treats a falsy return as
     *                                     "no provenance available" and continues the export.
     */
    public function createProvenanceResource($dataRecord = [], $encode = false): FHIRProvenance|string|false
    {
        if (!($dataRecord instanceof FHIRCondition)) {
            throw new \BadMethodCallException("Data record should be correct instance class");
        }
        $fhirProvenance = $this->getFhirProvenanceService()->createProvenanceForDomainResource($dataRecord);
        if ($fhirProvenance === null) {
            return false;
        }
        return $encode ? json_encode($fhirProvenance) : $fhirProvenance;
    }

    /**
     * Seam so unit tests can substitute the provenance factory.
     */
    protected function getFhirProvenanceService(): FhirProvenanceService
    {
        return new FhirProvenanceService();
    }
}

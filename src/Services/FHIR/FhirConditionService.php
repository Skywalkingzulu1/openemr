<?php

namespace DCL\Services\FHIR;

use DCL\Common\Logging\SystemLoggerAwareTrait;
use DCL\Common\Uuid\UuidRegistry;
use DCL\FHIR\R4\FHIRDomainResource\FHIRCondition;
use DCL\FHIR\R4\FHIRResource\FHIRDomainResource;
use DCL\Services\BaseService;
use DCL\Services\CodeTypesService;
use DCL\Services\ConditionService;
use DCL\Services\FHIR\Condition\FhirConditionEncounterDiagnosisService;
use DCL\Services\FHIR\Condition\FhirConditionHealthConcernService;
use DCL\Services\FHIR\Condition\FhirConditionProblemListItemService;
use DCL\Services\FHIR\Traits\BulkExportSupportAllOperationsTrait;
use DCL\Services\FHIR\Traits\FhirBulkExportDomainResourceTrait;
use DCL\Services\FHIR\Traits\FhirServiceBaseEmptyTrait;
use DCL\Services\FHIR\Traits\MappedServiceCodeTrait;
use DCL\Services\FHIR\Traits\VersionedProfileTrait;
use DCL\Services\Search\FhirSearchParameterDefinition;
use DCL\Services\Search\SearchFieldException;
use DCL\Services\Search\SearchFieldType;
use DCL\Services\Search\ServiceField;
use DCL\Services\Search\TokenSearchField;
use DCL\Validators\ProcessingResult;
use Psr\Log\LoggerInterface;

/**
 * FHIR Condition Service
 *
 * @package            DCL
 * @link               https://www.dcl.org
 * @author             Yash Bothra <yashrajbothra786gmail.com>
 * @author    Jerry Padgett <sjpadgett@gmail.com>
 * @copyright          Copyright (c) 2020 Yash Bothra <yashrajbothra786gmail.com>
 * @copyright Copyright (c) 2026 Jerry Padgett <sjpadgett@gmail.com>
 * @license            https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */
class FhirConditionService extends FhirServiceBase implements IResourceUSCIGProfileService, IFhirExportableResourceService, IPatientCompartmentResourceService
{
    use FhirServiceBaseEmptyTrait;
    use BulkExportSupportAllOperationsTrait;
    use FhirBulkExportDomainResourceTrait;
    use VersionedProfileTrait;
    use MappedServiceCodeTrait;
    use SystemLoggerAwareTrait;

    /**
     * @var ConditionService
     */
    private $conditionService;

    private FhirConditionProblemListItemService $problemListItemService;

    public function __construct()
    {
        parent::__construct();
        $this->problemListItemService = new FhirConditionProblemListItemService();
        $this->addMappedService(new FhirConditionEncounterDiagnosisService());
        $this->addMappedService($this->problemListItemService);
        $this->addMappedService(new FhirConditionHealthConcernService());
        $this->conditionService = new ConditionService();
    }

    /**
     * Re-emits a stored row as a FHIR resource. FhirServiceBase::update() calls this to build
     * the body of a PUT response, so leaving it on the empty trait answers a successful update
     * with a null body. The write path runs through ConditionService, which only ever writes
     * `lists` rows of type 'medical_problem', so the problem-list-item mapping is the one that
     * re-emits them.
     *
     * @param array<array-key, mixed> $dataRecord
     * @param bool $encode
     */
    public function parseDCLRecord($dataRecord = [], $encode = false)
    {
        return $this->problemListItemService->parseDCLRecord($dataRecord, $encode);
    }

    public function setSystemLogger(LoggerInterface $systemLogger): void
    {
        $this->logger = $systemLogger;
        foreach ($this->getMappedServices() as $service) {
            $service->setSystemLogger($systemLogger);
        }
    }

    /**
     * Returns an array mapping FHIR Condition Resource search parameters to DCL Condition search parameters
     *
     * @return array The search parameters
     */
    protected function loadSearchParameters(): array
    {
        return  [
            'patient' => $this->getPatientContextSearchField(),
            '_id' => new FhirSearchParameterDefinition('_id', SearchFieldType::TOKEN, [new ServiceField('condition_uuid', ServiceField::TYPE_UUID)]),
            '_lastUpdated' => $this->getLastModifiedSearchField(),
        ];
    }

    public function getLastModifiedSearchField(): ?FhirSearchParameterDefinition
    {
        return new FhirSearchParameterDefinition('_lastUpdated', SearchFieldType::DATETIME, ['last_updated_time']);
    }

    public function getAll($fhirSearchParameters, $puuidBind = null): ProcessingResult
    {
        $fhirSearchResult = new ProcessingResult();
        try {
            if (isset($puuidBind)) {
                $field = $this->getPatientContextSearchField();
                $fhirSearchParameters[$field->getName()] = $puuidBind;
            }

            $servicesMap = [];
            $services = [];
            if (isset($fhirSearchParameters['category'])) {
                /**
                 * @var TokenSearchField
                 */
                $category = $fhirSearchParameters['category'];

                $catServices = $this->getServiceListForCategory(
                    // TODO: @adunsulag should we put inside TokenSearchValue the exploding of the comma separated values?
                    new TokenSearchField('category', explode(",", $category))
                );
                foreach ($catServices as $service) {
                    $servicesMap[$service::class] = $service;
                }
                $services = $servicesMap;
            }
            if (empty($services)) {
                $services = $this->getMappedServices();
            }
            $fhirSearchResult = $this->searchServices($services, $fhirSearchParameters, $puuidBind);
        } catch (SearchFieldException $exception) {
            $systemLogger = $this->getSystemLogger();
            $systemLogger->error("exception thrown", ['exception' => $exception,
                'field' => $exception->getField()]);
            // put our exception information here
            $fhirSearchResult->setValidationMessages([$exception->getField() => $exception->getMessage()]);
        }
        return $fhirSearchResult;
    }

    /**
     * Parses a FHIR Condition resource, returning the equivalent DCL record.
     *
     * @param FHIRDomainResource $fhirResource The source FHIR resource
     * @return array a mapped DCL data record
     */
    public function parseFhirResource(FHIRDomainResource $fhirResource): array
    {
        if (!($fhirResource instanceof FHIRCondition)) {
            throw new \InvalidArgumentException(
                'Expected FHIRCondition resource, got ' . $fhirResource::class
            );
        }

        // Use jsonSerialize() to get a normalized array representation since
        // the FHIR R4 library does not deeply hydrate nested objects
        $json = $fhirResource->jsonSerialize();
        $data = [];

        $resourceId = $json['id'] ?? null;
        if (is_string($resourceId) && $resourceId !== '') {
            $data['uuid'] = $resourceId;
        }

        // Category -> subtype
        $categories = $json['category'] ?? null;
        $subtype = FhirPayloadReader::firstConceptCode($categories);
        if ($subtype !== '') {
            $data['subtype'] = $subtype;
        }

        // Subject -> puuid
        $subjectRef = FhirPayloadReader::reference($json['subject'] ?? null);
        if ($subjectRef !== null) {
            $subjectUuid = UtilsService::parseReferenceString($subjectRef, 'Patient')['uuid'] ?? null;
            if (
                is_string($subjectUuid) && $subjectUuid !== ''
                && \DCL\Common\Uuid\UuidRegistry::isValidStringUUID($subjectUuid)
            ) {
                $data['puuid'] = $subjectUuid;
            }
        }

        // Code -> title and diagnosis
        $code = $json['code'] ?? null;
        $codeCodings = FhirPayloadReader::codings($code);
        if ($codeCodings !== []) {
            $codeTypesService = new CodeTypesService();
            $diagnosisParts = [];
            foreach ($codeCodings as $coding) {
                $systemValue = $coding['system'] ?? null;
                $system = is_string($systemValue) ? $systemValue : '';
                $codeValue = $coding['code'] ?? null;
                if (is_scalar($codeValue) && $codeValue !== '' && $codeValue !== false) {
                    $diagnosisParts[] = $codeTypesService->getDCLCodeForSystemAndCode($system, $codeValue);
                }
                $display = $coding['display'] ?? null;
                if (is_string($display) && $display !== '' && !isset($data['title'])) {
                    $data['title'] = $display;
                }
            }
            if ($diagnosisParts !== []) {
                $data['diagnosis'] = implode(';', $diagnosisParts);
            }
        }
        $codeText = is_array($code) ? ($code['text'] ?? null) : null;
        if (!isset($data['title']) && is_string($codeText) && $codeText !== '') {
            $data['title'] = $codeText;
        }

        // ClinicalStatus -> outcome and occurrence
        $clinicalStatus = FhirPayloadReader::firstCodingCode($json['clinicalStatus'] ?? null);
        if ($clinicalStatus !== '') {
            $data['outcome'] = match ($clinicalStatus) {
                'resolved' => '1',
                'recurrence' => '0',
                default => '0',
            };
            if ($clinicalStatus === 'recurrence') {
                $data['occurrence'] = '2';
            }
        }

        // VerificationStatus -> verification
        $verification = FhirPayloadReader::firstCodingCode($json['verificationStatus'] ?? null);
        if ($verification !== '') {
            $data['verification'] = $verification;
        }

        // onsetDateTime -> begdate (ConditionValidator expects Y-m-d).
        // Partial precision (YYYY, YYYY-MM) is rejected rather than widened:
        // lists.begdate is a DATE column and a year-only onset cannot be stored
        // faithfully, so the caller gets a 400 instead of a fabricated day.
        $begdate = FhirDateTimeParser::toDbDate($json['onsetDateTime'] ?? null, 'Condition.onsetDateTime');
        if ($begdate !== null) {
            $data['begdate'] = $begdate;
        }

        // abatementDateTime -> enddate
        $enddate = FhirDateTimeParser::toDbDate($json['abatementDateTime'] ?? null, 'Condition.abatementDateTime');
        if ($enddate !== null) {
            $data['enddate'] = $enddate;
        }

        // Note -> comments. Condition.note is 0..*, and lists.comments is free text, so every
        // note is joined into it. Keeping only note[0] silently discarded the rest of a
        // clinician's notes on a request that reported success.
        $noteTexts = [];
        foreach (FhirPayloadReader::rows($json['note'] ?? null) as $note) {
            $noteText = FhirPayloadReader::getString($note, 'text');
            if ($noteText !== null && $noteText !== '') {
                $noteTexts[] = $noteText;
            }
        }
        if ($noteTexts !== []) {
            $data['comments'] = implode("\n\n", $noteTexts);
        }

        return $data;
    }

    /**
     * Inserts an DCL record into the system.
     *
     * @param mixed $openEmrRecord The parsed record from parseFhirResource()
     * @return ProcessingResult
     */
    protected function insertDCLRecord($openEmrRecord)
    {
        if (!is_array($openEmrRecord)) {
            throw new \InvalidArgumentException('Expected a parsed DCL Condition record array');
        }

        return $this->conditionService->insert($openEmrRecord);
    }

    /**
     * Updates an existing DCL record.
     *
     * @param string $fhirResourceId The DCL record's FHIR Resource ID (uuid)
     * @param array $updatedDCLRecord The updated DCL record
     * @return ProcessingResult
     */
    protected function updateDCLRecord($fhirResourceId, $updatedDCLRecord)
    {
        // The patient the caller asserts has to be the condition's actual owner. parseFhirResource()
        // sets puuid only when Condition.subject resolves, and without it update() has nothing to
        // compare the stored row against. Condition.subject is 1..1 in R4, so rejecting the
        // omission is also what the spec asks for, and it matches AllergyIntolerance,
        // MedicationRequest and ServiceRequest on this path.
        $puuid = $updatedDCLRecord['puuid'] ?? null;
        if (!is_string($puuid) || $puuid === '') {
            $result = new ProcessingResult();
            $result->setValidationMessages([
                'subject' => 'Condition.subject is required and must reference a known patient',
            ]);
            return $result;
        }

        $pid = BaseService::getIdByUuid(UuidRegistry::uuidToBytes($puuid), 'patient_data', 'pid');
        if (!is_numeric($pid)) {
            $result = new ProcessingResult();
            $result->setValidationMessages([
                'subject' => 'Patient reference could not be resolved: ' . $puuid,
            ]);
            return $result;
        }

        return $this->conditionService->update($fhirResourceId, $updatedDCLRecord, (int) $pid);
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
        $profileSets[] = $this->getProfileForVersions(FhirConditionProblemListItemService::USCGI_PROFILE_URI_3_1_1, ['', '3.1.1']);
        $profileSets[] = $this->getProfileForVersions(FhirConditionEncounterDiagnosisService::USCGI_PROFILE_ENCOUNTER_DIAGNOSIS_URI, $this->getSupportedVersions());
        $profileSets[] = $this->getProfileForVersions(FhirConditionProblemListItemService::USCGI_PROFILE_PROBLEMS_HEALTH_CONCERNS_URI, $this->getSupportedVersions());
        $profiles = array_merge(...$profileSets);
        return $profiles;
    }

    protected function getSupportedVersions(): array
    {
        return ['', '7.0.0', '8.0.0'];
    }

    public function getPatientContextSearchField(): FhirSearchParameterDefinition
    {
        return new FhirSearchParameterDefinition('patient', SearchFieldType::REFERENCE, [new ServiceField('puuid', ServiceField::TYPE_UUID)]);
    }
}

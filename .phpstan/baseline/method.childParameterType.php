<?php declare(strict_types = 1);

$ignoreErrors = [];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$inputFilter \\(Laminas\\\\InputFilter\\\\InputFilterInterface\\<mixed\\>\\) of method Carecoordination\\\\Model\\\\Configuration\\:\\:setInputFilter\\(\\) should be contravariant with parameter \\$inputFilter \\(Laminas\\\\InputFilter\\\\InputFilterInterface\\) of method Laminas\\\\InputFilter\\\\InputFilterAwareInterface\\:\\:setInputFilter\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../interface/modules/zend_modules/module/Carecoordination/src/Carecoordination/Model/Configuration.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$inputFilter \\(Laminas\\\\InputFilter\\\\InputFilterInterface\\<mixed\\>\\) of method Immunization\\\\Model\\\\Configuration\\:\\:setInputFilter\\(\\) should be contravariant with parameter \\$inputFilter \\(Laminas\\\\InputFilter\\\\InputFilterInterface\\) of method Laminas\\\\InputFilter\\\\InputFilterAwareInterface\\:\\:setInputFilter\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../interface/modules/zend_modules/module/Immunization/src/Immunization/Model/Configuration.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$inputFilter \\(Laminas\\\\InputFilter\\\\InputFilterInterface\\<mixed\\>\\) of method Syndromicsurveillance\\\\Model\\\\Configuration\\:\\:setInputFilter\\(\\) should be contravariant with parameter \\$inputFilter \\(Laminas\\\\InputFilter\\\\InputFilterInterface\\) of method Laminas\\\\InputFilter\\\\InputFilterAwareInterface\\:\\:setInputFilter\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../interface/modules/zend_modules/module/Syndromicsurveillance/src/Syndromicsurveillance/Model/Configuration.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$inputFilter \\(Laminas\\\\InputFilter\\\\InputFilterInterface\\<mixed\\>\\) of method Syndromicsurveillance\\\\Model\\\\Syndromicsurveillance\\:\\:setInputFilter\\(\\) should be contravariant with parameter \\$inputFilter \\(Laminas\\\\InputFilter\\\\InputFilterInterface\\) of method Laminas\\\\InputFilter\\\\InputFilterAwareInterface\\:\\:setInputFilter\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../interface/modules/zend_modules/module/Syndromicsurveillance/src/Syndromicsurveillance/Model/Syndromicsurveillance.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$criteriaType \\(DCL\\\\ClinicalDecisionRules\\\\Interface\\\\RuleLibrary\\\\RuleCriteriaType\\) of method DCL\\\\ClinicalDecisionRules\\\\Interface\\\\RuleLibrary\\\\RuleCriteriaAgeBuilder\\:\\:newInstance\\(\\) should be contravariant with parameter \\$criteriaType \\(mixed\\) of method DCL\\\\ClinicalDecisionRules\\\\Interface\\\\RuleLibrary\\\\RuleCriteriaBuilder\\:\\:newInstance\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/ClinicalDecisionRules/Interface/RuleLibrary/RuleCriteriaAgeBuilder.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$ruleCriteriaType \\(DCL\\\\ClinicalDecisionRules\\\\Interface\\\\RuleLibrary\\\\RuleCriteriaType\\) of method DCL\\\\ClinicalDecisionRules\\\\Interface\\\\RuleLibrary\\\\RuleCriteriaDatabaseBuilder\\:\\:newInstance\\(\\) should be contravariant with parameter \\$criteriaType \\(mixed\\) of method DCL\\\\ClinicalDecisionRules\\\\Interface\\\\RuleLibrary\\\\RuleCriteriaBuilder\\:\\:newInstance\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/ClinicalDecisionRules/Interface/RuleLibrary/RuleCriteriaDatabaseBuilder.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$criteriaType \\(DCL\\\\ClinicalDecisionRules\\\\Interface\\\\RuleLibrary\\\\RuleCriteriaType\\) of method DCL\\\\ClinicalDecisionRules\\\\Interface\\\\RuleLibrary\\\\RuleCriteriaSexBuilder\\:\\:newInstance\\(\\) should be contravariant with parameter \\$criteriaType \\(mixed\\) of method DCL\\\\ClinicalDecisionRules\\\\Interface\\\\RuleLibrary\\\\RuleCriteriaBuilder\\:\\:newInstance\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/ClinicalDecisionRules/Interface/RuleLibrary/RuleCriteriaSexBuilder.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$criteria \\(DCL\\\\ClinicalDecisionRules\\\\Interface\\\\RuleLibrary\\\\RuleCriteria\\) of method DCL\\\\ClinicalDecisionRules\\\\Interface\\\\RuleLibrary\\\\RuleCriteriaTargetFactory\\:\\:modify\\(\\) should be contravariant with parameter \\$criteria \\(mixed\\) of method DCL\\\\ClinicalDecisionRules\\\\Interface\\\\RuleLibrary\\\\RuleCriteriaFactory\\:\\:modify\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/ClinicalDecisionRules/Interface/RuleLibrary/RuleCriteriaTargetFactory.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$scopes \\(array\\|string\\) of method DCL\\\\Common\\\\Auth\\\\OpenIDConnect\\\\Grant\\\\CustomRefreshTokenGrant\\:\\:validateScopes\\(\\) should be contravariant with parameter \\$scopes \\(array\\|string\\|null\\) of method League\\\\OAuth2\\\\Server\\\\Grant\\\\AbstractGrant\\:\\:validateScopes\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Common/Auth/OpenIDConnect/Grant/CustomRefreshTokenGrant.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$scopes \\(array\\<DCL\\\\Common\\\\Auth\\\\OpenIDConnect\\\\Entities\\\\ScopeEntity\\>\\) of method DCL\\\\Common\\\\Auth\\\\OpenIDConnect\\\\Repositories\\\\ScopeRepository\\:\\:finalizeScopes\\(\\) should be contravariant with parameter \\$scopes \\(array\\<League\\\\OAuth2\\\\Server\\\\Entities\\\\ScopeEntityInterface\\>\\) of method League\\\\OAuth2\\\\Server\\\\Repositories\\\\ScopeRepositoryInterface\\:\\:finalizeScopes\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Common/Auth/OpenIDConnect/Repositories/ScopeRepository.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$results \\(array\\) of method DCL\\\\Common\\\\ORDataObject\\\\Person\\:\\:populate_array\\(\\) should be contravariant with parameter \\$results \\(mixed\\) of method DCL\\\\Common\\\\ORDataObject\\\\ORDataObject\\:\\:populate_array\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Common/ORDataObject/Person.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#2 \\$isAndCondition \\(bool\\) of method DCL\\\\Services\\\\AllergyIntoleranceService\\:\\:search\\(\\) should be contravariant with parameter \\$isAndCondition \\(mixed\\) of method DCL\\\\Services\\\\BaseServiceInterface\\:\\:search\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/AllergyIntoleranceService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#2 \\$isAndCondition \\(bool\\) of method DCL\\\\Services\\\\AppointmentService\\:\\:search\\(\\) should be contravariant with parameter \\$isAndCondition \\(mixed\\) of method DCL\\\\Services\\\\BaseServiceInterface\\:\\:search\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/AppointmentService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$data \\(array\\) of method DCL\\\\Services\\\\BaseService\\:\\:filterData\\(\\) should be contravariant with parameter \\$data \\(mixed\\) of method DCL\\\\Services\\\\BaseServiceInterface\\:\\:filterData\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/BaseService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$date \\(string\\) of method DCL\\\\Services\\\\BaseService\\:\\:processDateTime\\(\\) should be contravariant with parameter \\$date \\(mixed\\) of method DCL\\\\Services\\\\BaseServiceInterface\\:\\:processDateTime\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/BaseService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$id \\(string\\) of method DCL\\\\Services\\\\BaseService\\:\\:getUuidById\\(\\) should be contravariant with parameter \\$id \\(mixed\\) of method DCL\\\\Services\\\\BaseServiceInterface\\:\\:getUuidById\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/BaseService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$idField \\(string\\) of method DCL\\\\Services\\\\BaseService\\:\\:getFreshId\\(\\) should be contravariant with parameter \\$idField \\(mixed\\) of method DCL\\\\Services\\\\BaseServiceInterface\\:\\:getFreshId\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/BaseService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$map \\(array\\) of method DCL\\\\Services\\\\BaseService\\:\\:queryFields\\(\\) should be contravariant with parameter \\$map \\(mixed\\) of method DCL\\\\Services\\\\BaseServiceInterface\\:\\:queryFields\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/BaseService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$uuid \\(string\\) of method DCL\\\\Services\\\\BaseService\\:\\:getIdByUuid\\(\\) should be contravariant with parameter \\$uuid \\(mixed\\) of method DCL\\\\Services\\\\BaseServiceInterface\\:\\:getIdByUuid\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/BaseService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#2 \\$isAndCondition \\(bool\\) of method DCL\\\\Services\\\\BaseService\\:\\:search\\(\\) should be contravariant with parameter \\$isAndCondition \\(mixed\\) of method DCL\\\\Services\\\\BaseServiceInterface\\:\\:search\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/BaseService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#2 \\$table \\(string\\) of method DCL\\\\Services\\\\BaseService\\:\\:getFreshId\\(\\) should be contravariant with parameter \\$table \\(mixed\\) of method DCL\\\\Services\\\\BaseServiceInterface\\:\\:getFreshId\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/BaseService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#2 \\$table \\(string\\) of method DCL\\\\Services\\\\BaseService\\:\\:getIdByUuid\\(\\) should be contravariant with parameter \\$table \\(mixed\\) of method DCL\\\\Services\\\\BaseServiceInterface\\:\\:getIdByUuid\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/BaseService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#2 \\$table \\(string\\) of method DCL\\\\Services\\\\BaseService\\:\\:getUuidById\\(\\) should be contravariant with parameter \\$table \\(mixed\\) of method DCL\\\\Services\\\\BaseServiceInterface\\:\\:getUuidById\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/BaseService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#2 \\$whitelistedFields \\(array\\) of method DCL\\\\Services\\\\BaseService\\:\\:filterData\\(\\) should be contravariant with parameter \\$whitelistedFields \\(mixed\\) of method DCL\\\\Services\\\\BaseServiceInterface\\:\\:filterData\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/BaseService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#3 \\$field \\(string\\) of method DCL\\\\Services\\\\BaseService\\:\\:getIdByUuid\\(\\) should be contravariant with parameter \\$field \\(mixed\\) of method DCL\\\\Services\\\\BaseServiceInterface\\:\\:getIdByUuid\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/BaseService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#3 \\$field \\(string\\) of method DCL\\\\Services\\\\BaseService\\:\\:getUuidById\\(\\) should be contravariant with parameter \\$field \\(mixed\\) of method DCL\\\\Services\\\\BaseServiceInterface\\:\\:getUuidById\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/BaseService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#2 \\$isAndCondition \\(bool\\) of method DCL\\\\Services\\\\CarePlanService\\:\\:search\\(\\) should be contravariant with parameter \\$isAndCondition \\(mixed\\) of method DCL\\\\Services\\\\BaseServiceInterface\\:\\:search\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/CarePlanService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#2 \\$isAndCondition \\(bool\\) of method DCL\\\\Services\\\\CareTeamService\\:\\:search\\(\\) should be contravariant with parameter \\$isAndCondition \\(mixed\\) of method DCL\\\\Services\\\\BaseServiceInterface\\:\\:search\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/CareTeamService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#2 \\$isAndCondition \\(bool\\) of method DCL\\\\Services\\\\ClinicalNotesService\\:\\:search\\(\\) should be contravariant with parameter \\$isAndCondition \\(mixed\\) of method DCL\\\\Services\\\\BaseServiceInterface\\:\\:search\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/ClinicalNotesService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#2 \\$isAndCondition \\(bool\\) of method DCL\\\\Services\\\\ConditionService\\:\\:search\\(\\) should be contravariant with parameter \\$isAndCondition \\(mixed\\) of method DCL\\\\Services\\\\BaseServiceInterface\\:\\:search\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/ConditionService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#2 \\$isAndCondition \\(bool\\) of method DCL\\\\Services\\\\DeviceService\\:\\:search\\(\\) should be contravariant with parameter \\$isAndCondition \\(mixed\\) of method DCL\\\\Services\\\\BaseServiceInterface\\:\\:search\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/DeviceService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#2 \\$isAndCondition \\(bool\\) of method DCL\\\\Services\\\\DocumentService\\:\\:search\\(\\) should be contravariant with parameter \\$isAndCondition \\(mixed\\) of method DCL\\\\Services\\\\BaseServiceInterface\\:\\:search\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/DocumentService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#2 \\$isAndCondition \\(bool\\) of method DCL\\\\Services\\\\DrugSalesService\\:\\:search\\(\\) should be contravariant with parameter \\$isAndCondition \\(mixed\\) of method DCL\\\\Services\\\\BaseServiceInterface\\:\\:search\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/DrugSalesService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#2 \\$isAndCondition \\(bool\\) of method DCL\\\\Services\\\\DrugService\\:\\:search\\(\\) should be contravariant with parameter \\$isAndCondition \\(mixed\\) of method DCL\\\\Services\\\\BaseServiceInterface\\:\\:search\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/DrugService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#2 \\$isAndCondition \\(bool\\) of method DCL\\\\Services\\\\EmployerService\\:\\:search\\(\\) should be contravariant with parameter \\$isAndCondition \\(mixed\\) of method DCL\\\\Services\\\\BaseServiceInterface\\:\\:search\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/EmployerService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#2 \\$isAndCondition \\(bool\\) of method DCL\\\\Services\\\\EncounterService\\:\\:search\\(\\) should be contravariant with parameter \\$isAndCondition \\(mixed\\) of method DCL\\\\Services\\\\BaseServiceInterface\\:\\:search\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/EncounterService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$DCLSearchParameters \\(array\\<string, DCL\\\\Services\\\\Search\\\\ISearchField\\>\\) of method DCL\\\\Services\\\\FHIR\\\\Condition\\\\FhirConditionEncounterDiagnosisService\\:\\:searchForDCLRecords\\(\\) should be contravariant with parameter \\$DCLSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:searchForDCLRecords\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/Condition/FhirConditionEncounterDiagnosisService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$DCLSearchParameters \\(array\\<string, DCL\\\\Services\\\\Search\\\\ISearchField\\>\\) of method DCL\\\\Services\\\\FHIR\\\\Condition\\\\FhirConditionHealthConcernService\\:\\:searchForDCLRecords\\(\\) should be contravariant with parameter \\$DCLSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:searchForDCLRecords\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/Condition/FhirConditionHealthConcernService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$DCLSearchParameters \\(array\\<string, DCL\\\\Services\\\\Search\\\\ISearchField\\>\\) of method DCL\\\\Services\\\\FHIR\\\\Condition\\\\FhirConditionProblemListItemService\\:\\:searchForDCLRecords\\(\\) should be contravariant with parameter \\$DCLSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:searchForDCLRecords\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/Condition/FhirConditionProblemListItemService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$DCLSearchParameters \\(array\\<string, DCL\\\\Services\\\\Search\\\\ISearchField\\>\\) of method DCL\\\\Services\\\\FHIR\\\\DiagnosticReport\\\\FhirDiagnosticReportClinicalNotesService\\:\\:searchForDCLRecords\\(\\) should be contravariant with parameter \\$DCLSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:searchForDCLRecords\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/DiagnosticReport/FhirDiagnosticReportClinicalNotesService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$dataRecord \\(DCL\\\\FHIR\\\\R4\\\\FHIRDomainResource\\\\FHIRDiagnosticReport\\) of method DCL\\\\Services\\\\FHIR\\\\DiagnosticReport\\\\FhirDiagnosticReportLaboratoryService\\:\\:createProvenanceResource\\(\\) should be contravariant with parameter \\$dataRecord \\(mixed\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:createProvenanceResource\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/DiagnosticReport/FhirDiagnosticReportLaboratoryService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$DCLSearchParameters \\(array\\<string, DCL\\\\Services\\\\Search\\\\ISearchField\\>\\) of method DCL\\\\Services\\\\FHIR\\\\DiagnosticReport\\\\FhirDiagnosticReportLaboratoryService\\:\\:searchForDCLRecords\\(\\) should be contravariant with parameter \\$DCLSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:searchForDCLRecords\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/DiagnosticReport/FhirDiagnosticReportLaboratoryService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$DCLSearchParameters \\(array\\<string, DCL\\\\Services\\\\Search\\\\ISearchField\\>\\) of method DCL\\\\Services\\\\FHIR\\\\DocumentReference\\\\FhirClinicalNotesService\\:\\:searchForDCLRecords\\(\\) should be contravariant with parameter \\$DCLSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:searchForDCLRecords\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/DocumentReference/FhirClinicalNotesService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$DCLSearchParameters \\(array\\<string, DCL\\\\Services\\\\Search\\\\ISearchField\\>\\) of method DCL\\\\Services\\\\FHIR\\\\DocumentReference\\\\FhirDocumentReferenceAdvanceCareDirectiveService\\:\\:searchForDCLRecords\\(\\) should be contravariant with parameter \\$DCLSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:searchForDCLRecords\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/DocumentReference/FhirDocumentReferenceAdvanceCareDirectiveService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$DCLSearchParameters \\(array\\<string, DCL\\\\Services\\\\Search\\\\ISearchField\\>\\) of method DCL\\\\Services\\\\FHIR\\\\DocumentReference\\\\FhirPatientDocumentReferenceService\\:\\:searchForDCLRecords\\(\\) should be contravariant with parameter \\$DCLSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:searchForDCLRecords\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/DocumentReference/FhirPatientDocumentReferenceService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$dataRecord \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirAllergyIntoleranceService\\:\\:createProvenanceResource\\(\\) should be contravariant with parameter \\$dataRecord \\(mixed\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:createProvenanceResource\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirAllergyIntoleranceService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$DCLSearchParameters \\(array\\<string, DCL\\\\Services\\\\Search\\\\ISearchField\\>\\) of method DCL\\\\Services\\\\FHIR\\\\FhirAllergyIntoleranceService\\:\\:searchForDCLRecords\\(\\) should be contravariant with parameter \\$DCLSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:searchForDCLRecords\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirAllergyIntoleranceService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$DCLSearchParameters \\(array\\<string, DCL\\\\Services\\\\Search\\\\ISearchField\\>\\) of method DCL\\\\Services\\\\FHIR\\\\FhirAppointmentService\\:\\:searchForDCLRecords\\(\\) should be contravariant with parameter \\$DCLSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:searchForDCLRecords\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirAppointmentService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$DCLSearchParameters \\(array\\<string, DCL\\\\Services\\\\Search\\\\ISearchField\\>\\) of method DCL\\\\Services\\\\FHIR\\\\FhirCarePlanService\\:\\:searchForDCLRecords\\(\\) should be contravariant with parameter \\$DCLSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:searchForDCLRecords\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirCarePlanService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$fhirSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirConditionService\\:\\:getAll\\(\\) should be contravariant with parameter \\$fhirSearchParameters \\(mixed\\) of method DCL\\\\Services\\\\FHIR\\\\IResourceReadableService\\:\\:getAll\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirConditionService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$DCLSearchParameters \\(array\\<string, DCL\\\\Services\\\\Search\\\\ISearchField\\>\\) of method DCL\\\\Services\\\\FHIR\\\\FhirConditionService\\:\\:searchForDCLRecords\\(\\) should be contravariant with parameter \\$DCLSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:searchForDCLRecords\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirConditionService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#2 \\$puuidBind \\(string\\|null\\) of method DCL\\\\Services\\\\FHIR\\\\FhirConditionService\\:\\:getAll\\(\\) should be contravariant with parameter \\$puuidBind \\(mixed\\) of method DCL\\\\Services\\\\FHIR\\\\IResourceReadableService\\:\\:getAll\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirConditionService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$dataRecord \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirCoverageService\\:\\:createProvenanceResource\\(\\) should be contravariant with parameter \\$dataRecord \\(mixed\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:createProvenanceResource\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirCoverageService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$DCLSearchParameters \\(array\\<string, DCL\\\\Services\\\\Search\\\\ISearchField\\>\\) of method DCL\\\\Services\\\\FHIR\\\\FhirCoverageService\\:\\:searchForDCLRecords\\(\\) should be contravariant with parameter \\$DCLSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:searchForDCLRecords\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirCoverageService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$DCLSearchParameters \\(array\\<string, DCL\\\\Services\\\\Search\\\\ISearchField\\>\\) of method DCL\\\\Services\\\\FHIR\\\\FhirDeviceService\\:\\:searchForDCLRecords\\(\\) should be contravariant with parameter \\$DCLSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:searchForDCLRecords\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirDeviceService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$fhirSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirDiagnosticReportService\\:\\:getAll\\(\\) should be contravariant with parameter \\$fhirSearchParameters \\(mixed\\) of method DCL\\\\Services\\\\FHIR\\\\IResourceReadableService\\:\\:getAll\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirDiagnosticReportService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$DCLSearchParameters \\(array\\<string, DCL\\\\Services\\\\Search\\\\ISearchField\\>\\) of method DCL\\\\Services\\\\FHIR\\\\FhirDiagnosticReportService\\:\\:searchForDCLRecords\\(\\) should be contravariant with parameter \\$DCLSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:searchForDCLRecords\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirDiagnosticReportService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#2 \\$puuidBind \\(string\\|null\\) of method DCL\\\\Services\\\\FHIR\\\\FhirDiagnosticReportService\\:\\:getAll\\(\\) should be contravariant with parameter \\$puuidBind \\(mixed\\) of method DCL\\\\Services\\\\FHIR\\\\IResourceReadableService\\:\\:getAll\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirDiagnosticReportService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$fhirSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirDocumentReferenceService\\:\\:getAll\\(\\) should be contravariant with parameter \\$fhirSearchParameters \\(mixed\\) of method DCL\\\\Services\\\\FHIR\\\\IResourceReadableService\\:\\:getAll\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirDocumentReferenceService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$DCLSearchParameters \\(array\\<string, DCL\\\\Services\\\\Search\\\\ISearchField\\>\\) of method DCL\\\\Services\\\\FHIR\\\\FhirDocumentReferenceService\\:\\:searchForDCLRecords\\(\\) should be contravariant with parameter \\$DCLSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:searchForDCLRecords\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirDocumentReferenceService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#2 \\$puuidBind \\(string\\|null\\) of method DCL\\\\Services\\\\FHIR\\\\FhirDocumentReferenceService\\:\\:getAll\\(\\) should be contravariant with parameter \\$puuidBind \\(mixed\\) of method DCL\\\\Services\\\\FHIR\\\\IResourceReadableService\\:\\:getAll\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirDocumentReferenceService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$DCLSearchParameters \\(array\\<string, DCL\\\\Services\\\\Search\\\\ISearchField\\>\\) of method DCL\\\\Services\\\\FHIR\\\\FhirGoalService\\:\\:searchForDCLRecords\\(\\) should be contravariant with parameter \\$DCLSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:searchForDCLRecords\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirGoalService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$fhirSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirGroupService\\:\\:getAll\\(\\) should be contravariant with parameter \\$fhirSearchParameters \\(mixed\\) of method DCL\\\\Services\\\\FHIR\\\\IResourceReadableService\\:\\:getAll\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirGroupService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$DCLSearchParameters \\(array\\<string, DCL\\\\Services\\\\Search\\\\ISearchField\\>\\) of method DCL\\\\Services\\\\FHIR\\\\FhirGroupService\\:\\:searchForDCLRecords\\(\\) should be contravariant with parameter \\$DCLSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:searchForDCLRecords\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirGroupService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#2 \\$puuidBind \\(string\\|null\\) of method DCL\\\\Services\\\\FHIR\\\\FhirGroupService\\:\\:getAll\\(\\) should be contravariant with parameter \\$puuidBind \\(mixed\\) of method DCL\\\\Services\\\\FHIR\\\\IResourceReadableService\\:\\:getAll\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirGroupService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$DCLSearchParameters \\(array\\<string, DCL\\\\Services\\\\Search\\\\ISearchField\\>\\) of method DCL\\\\Services\\\\FHIR\\\\FhirImmunizationService\\:\\:searchForDCLRecords\\(\\) should be contravariant with parameter \\$DCLSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:searchForDCLRecords\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirImmunizationService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$fhirSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirLocationService\\:\\:getAll\\(\\) should be contravariant with parameter \\$fhirSearchParameters \\(mixed\\) of method DCL\\\\Services\\\\FHIR\\\\IResourceReadableService\\:\\:getAll\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirLocationService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$DCLSearchParameters \\(array\\<string, DCL\\\\Services\\\\Search\\\\ISearchField\\>\\) of method DCL\\\\Services\\\\FHIR\\\\FhirLocationService\\:\\:searchForDCLRecords\\(\\) should be contravariant with parameter \\$DCLSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:searchForDCLRecords\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirLocationService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#2 \\$puuidBind \\(string\\|null\\) of method DCL\\\\Services\\\\FHIR\\\\FhirLocationService\\:\\:getAll\\(\\) should be contravariant with parameter \\$puuidBind \\(mixed\\) of method DCL\\\\Services\\\\FHIR\\\\IResourceReadableService\\:\\:getAll\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirLocationService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$fhirSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirMedicationDispenseService\\:\\:getAll\\(\\) should be contravariant with parameter \\$fhirSearchParameters \\(mixed\\) of method DCL\\\\Services\\\\FHIR\\\\IResourceReadableService\\:\\:getAll\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirMedicationDispenseService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$DCLSearchParameters \\(array\\<string, DCL\\\\Services\\\\Search\\\\ISearchField\\>\\) of method DCL\\\\Services\\\\FHIR\\\\FhirMedicationDispenseService\\:\\:searchForDCLRecords\\(\\) should be contravariant with parameter \\$DCLSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:searchForDCLRecords\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirMedicationDispenseService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#2 \\$puuidBind \\(string\\|null\\) of method DCL\\\\Services\\\\FHIR\\\\FhirMedicationDispenseService\\:\\:getAll\\(\\) should be contravariant with parameter \\$puuidBind \\(mixed\\) of method DCL\\\\Services\\\\FHIR\\\\IResourceReadableService\\:\\:getAll\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirMedicationDispenseService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$DCLSearchParameters \\(array\\<string, DCL\\\\Services\\\\Search\\\\ISearchField\\>\\) of method DCL\\\\Services\\\\FHIR\\\\FhirMedicationRequestService\\:\\:searchForDCLRecords\\(\\) should be contravariant with parameter \\$DCLSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:searchForDCLRecords\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirMedicationRequestService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$DCLSearchParameters \\(array\\<string, DCL\\\\Services\\\\Search\\\\ISearchField\\>\\) of method DCL\\\\Services\\\\FHIR\\\\FhirMedicationService\\:\\:searchForDCLRecords\\(\\) should be contravariant with parameter \\$DCLSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:searchForDCLRecords\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirMedicationService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$fhirSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirObservationService\\:\\:getAll\\(\\) should be contravariant with parameter \\$fhirSearchParameters \\(mixed\\) of method DCL\\\\Services\\\\FHIR\\\\IResourceReadableService\\:\\:getAll\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirObservationService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$DCLSearchParameters \\(array\\<string, DCL\\\\Services\\\\Search\\\\ISearchField\\>\\) of method DCL\\\\Services\\\\FHIR\\\\FhirObservationService\\:\\:searchForDCLRecords\\(\\) should be contravariant with parameter \\$DCLSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:searchForDCLRecords\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirObservationService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#2 \\$puuidBind \\(string\\|null\\) of method DCL\\\\Services\\\\FHIR\\\\FhirObservationService\\:\\:getAll\\(\\) should be contravariant with parameter \\$puuidBind \\(mixed\\) of method DCL\\\\Services\\\\FHIR\\\\IResourceReadableService\\:\\:getAll\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirObservationService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$DCLSearchParameters \\(array\\<string, DCL\\\\Services\\\\Search\\\\ISearchField\\>\\) of method DCL\\\\Services\\\\FHIR\\\\FhirPatientService\\:\\:searchForDCLRecords\\(\\) should be contravariant with parameter \\$DCLSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:searchForDCLRecords\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirPatientService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$openEmrRecord \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirPatientService\\:\\:insertDCLRecord\\(\\) should be contravariant with parameter \\$openEmrRecord \\(mixed\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:insertDCLRecord\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirPatientService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$DCLSearchParameters \\(array\\<string, DCL\\\\Services\\\\Search\\\\ISearchField\\>\\) of method DCL\\\\Services\\\\FHIR\\\\FhirPersonService\\:\\:searchForDCLRecords\\(\\) should be contravariant with parameter \\$DCLSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:searchForDCLRecords\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirPersonService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$DCLSearchParameters \\(array\\<string, DCL\\\\Services\\\\Search\\\\ISearchField\\>\\) of method DCL\\\\Services\\\\FHIR\\\\FhirPractitionerRoleService\\:\\:searchForDCLRecords\\(\\) should be contravariant with parameter \\$DCLSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:searchForDCLRecords\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirPractitionerRoleService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$DCLSearchParameters \\(array\\<string, DCL\\\\Services\\\\Search\\\\ISearchField\\>\\) of method DCL\\\\Services\\\\FHIR\\\\FhirPractitionerService\\:\\:searchForDCLRecords\\(\\) should be contravariant with parameter \\$DCLSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:searchForDCLRecords\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirPractitionerService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$openEmrRecord \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirPractitionerService\\:\\:insertDCLRecord\\(\\) should be contravariant with parameter \\$openEmrRecord \\(mixed\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:insertDCLRecord\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirPractitionerService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$fhirSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirProcedureService\\:\\:getAll\\(\\) should be contravariant with parameter \\$fhirSearchParameters \\(mixed\\) of method DCL\\\\Services\\\\FHIR\\\\IResourceReadableService\\:\\:getAll\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirProcedureService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$DCLSearchParameters \\(array\\<string, DCL\\\\Services\\\\Search\\\\ISearchField\\>\\) of method DCL\\\\Services\\\\FHIR\\\\FhirProcedureService\\:\\:searchForDCLRecords\\(\\) should be contravariant with parameter \\$DCLSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:searchForDCLRecords\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirProcedureService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#2 \\$puuidBind \\(string\\|null\\) of method DCL\\\\Services\\\\FHIR\\\\FhirProcedureService\\:\\:getAll\\(\\) should be contravariant with parameter \\$puuidBind \\(mixed\\) of method DCL\\\\Services\\\\FHIR\\\\IResourceReadableService\\:\\:getAll\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirProcedureService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$fhirSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirProvenanceService\\:\\:getAll\\(\\) should be contravariant with parameter \\$fhirSearchParameters \\(mixed\\) of method DCL\\\\Services\\\\FHIR\\\\IResourceReadableService\\:\\:getAll\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirProvenanceService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$DCLSearchParameters \\(array\\<string, DCL\\\\Services\\\\Search\\\\ISearchField\\>\\) of method DCL\\\\Services\\\\FHIR\\\\FhirProvenanceService\\:\\:searchForDCLRecords\\(\\) should be contravariant with parameter \\$DCLSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:searchForDCLRecords\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirProvenanceService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#2 \\$puuidBind \\(string\\|null\\) of method DCL\\\\Services\\\\FHIR\\\\FhirProvenanceService\\:\\:getAll\\(\\) should be contravariant with parameter \\$puuidBind \\(mixed\\) of method DCL\\\\Services\\\\FHIR\\\\IResourceReadableService\\:\\:getAll\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirProvenanceService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$fhirSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirQuestionnaireResponseService\\:\\:getAll\\(\\) should be contravariant with parameter \\$fhirSearchParameters \\(mixed\\) of method DCL\\\\Services\\\\FHIR\\\\IResourceReadableService\\:\\:getAll\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirQuestionnaireResponseService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$DCLSearchParameters \\(array\\<string, DCL\\\\Services\\\\Search\\\\ISearchField\\>\\) of method DCL\\\\Services\\\\FHIR\\\\FhirQuestionnaireResponseService\\:\\:searchForDCLRecords\\(\\) should be contravariant with parameter \\$DCLSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:searchForDCLRecords\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirQuestionnaireResponseService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#2 \\$puuidBind \\(string\\|null\\) of method DCL\\\\Services\\\\FHIR\\\\FhirQuestionnaireResponseService\\:\\:getAll\\(\\) should be contravariant with parameter \\$puuidBind \\(mixed\\) of method DCL\\\\Services\\\\FHIR\\\\IResourceReadableService\\:\\:getAll\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirQuestionnaireResponseService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$dataRecord \\(DCL\\\\FHIR\\\\R4\\\\FHIRResource\\\\FHIRDomainResource\\) of method DCL\\\\Services\\\\FHIR\\\\FhirQuestionnaireService\\:\\:createProvenanceResource\\(\\) should be contravariant with parameter \\$dataRecord \\(mixed\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:createProvenanceResource\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirQuestionnaireService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$fhirSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirQuestionnaireService\\:\\:getAll\\(\\) should be contravariant with parameter \\$fhirSearchParameters \\(mixed\\) of method DCL\\\\Services\\\\FHIR\\\\IResourceReadableService\\:\\:getAll\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirQuestionnaireService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$DCLSearchParameters \\(array\\<string, DCL\\\\Services\\\\Search\\\\ISearchField\\>\\) of method DCL\\\\Services\\\\FHIR\\\\FhirQuestionnaireService\\:\\:searchForDCLRecords\\(\\) should be contravariant with parameter \\$DCLSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:searchForDCLRecords\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirQuestionnaireService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#2 \\$puuidBind \\(string\\) of method DCL\\\\Services\\\\FHIR\\\\FhirQuestionnaireService\\:\\:getAll\\(\\) should be contravariant with parameter \\$puuidBind \\(mixed\\) of method DCL\\\\Services\\\\FHIR\\\\IResourceReadableService\\:\\:getAll\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirQuestionnaireService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#2 \\$puuidBind \\(string\\) of method DCL\\\\Services\\\\FHIR\\\\FhirQuestionnaireService\\:\\:getAll\\(\\) should be contravariant with parameter \\$puuidBind \\(string\\|null\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:getAll\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirQuestionnaireService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$DCLSearchParameters \\(array\\<DCL\\\\Services\\\\Search\\\\ISearchField\\>\\) of method DCL\\\\Services\\\\FHIR\\\\FhirRelatedPersonService\\:\\:searchForDCLRecords\\(\\) should be contravariant with parameter \\$DCLSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:searchForDCLRecords\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirRelatedPersonService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$fhirResourceId \\(string\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:update\\(\\) should be contravariant with parameter \\$fhirResourceId \\(mixed\\) of method DCL\\\\Services\\\\FHIR\\\\IResourceUpdateableService\\:\\:update\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirServiceBase.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$fhirSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:getAll\\(\\) should be contravariant with parameter \\$fhirSearchParameters \\(mixed\\) of method DCL\\\\Services\\\\FHIR\\\\IResourceReadableService\\:\\:getAll\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirServiceBase.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#2 \\$puuidBind \\(string\\|null\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:getAll\\(\\) should be contravariant with parameter \\$puuidBind \\(mixed\\) of method DCL\\\\Services\\\\FHIR\\\\IResourceReadableService\\:\\:getAll\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirServiceBase.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$DCLSearchParameters \\(array\\<string, DCL\\\\Services\\\\Search\\\\ISearchField\\>\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceRequestService\\:\\:searchForDCLRecords\\(\\) should be contravariant with parameter \\$DCLSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:searchForDCLRecords\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirServiceRequestService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$DCLSearchParameters \\(array\\<string, DCL\\\\Services\\\\Search\\\\ISearchField\\>\\) of method DCL\\\\Services\\\\FHIR\\\\FhirSpecimenService\\:\\:searchForDCLRecords\\(\\) should be contravariant with parameter \\$DCLSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:searchForDCLRecords\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirSpecimenService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$fhirSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirValueSetService\\:\\:getAll\\(\\) should be contravariant with parameter \\$fhirSearchParameters \\(mixed\\) of method DCL\\\\Services\\\\FHIR\\\\IResourceReadableService\\:\\:getAll\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirValueSetService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$DCLSearchParameters \\(array\\<string, DCL\\\\Services\\\\Search\\\\ISearchField\\>\\) of method DCL\\\\Services\\\\FHIR\\\\FhirValueSetService\\:\\:searchForDCLRecords\\(\\) should be contravariant with parameter \\$DCLSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:searchForDCLRecords\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirValueSetService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#2 \\$puuidBind \\(string\\|null\\) of method DCL\\\\Services\\\\FHIR\\\\FhirValueSetService\\:\\:getAll\\(\\) should be contravariant with parameter \\$puuidBind \\(mixed\\) of method DCL\\\\Services\\\\FHIR\\\\IResourceReadableService\\:\\:getAll\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/FhirValueSetService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$DCLSearchParameters \\(array\\<string, DCL\\\\Services\\\\Search\\\\ISearchField\\>\\) of method DCL\\\\Services\\\\FHIR\\\\Group\\\\FhirPatientProviderGroupService\\:\\:searchForDCLRecords\\(\\) should be contravariant with parameter \\$DCLSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:searchForDCLRecords\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/Group/FhirPatientProviderGroupService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$dataRecord \\(DCL\\\\FHIR\\\\R4\\\\FHIRResource\\\\FHIRDomainResource\\) of method DCL\\\\Services\\\\FHIR\\\\Observation\\\\FhirObservationAdvanceDirectiveService\\:\\:createProvenanceResource\\(\\) should be contravariant with parameter \\$dataRecord \\(mixed\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:createProvenanceResource\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/Observation/FhirObservationAdvanceDirectiveService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$DCLSearchParameters \\(array\\<string, DCL\\\\Services\\\\FHIR\\\\Observation\\\\ISearchField\\>\\) of method DCL\\\\Services\\\\FHIR\\\\Observation\\\\FhirObservationAdvanceDirectiveService\\:\\:searchForDCLRecords\\(\\) should be contravariant with parameter \\$DCLSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:searchForDCLRecords\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/Observation/FhirObservationAdvanceDirectiveService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$dataRecord \\(DCL\\\\FHIR\\\\R4\\\\FHIRResource\\\\FHIRDomainResource\\) of method DCL\\\\Services\\\\FHIR\\\\Observation\\\\FhirObservationEmployerService\\:\\:createProvenanceResource\\(\\) should be contravariant with parameter \\$dataRecord \\(mixed\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:createProvenanceResource\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/Observation/FhirObservationEmployerService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$DCLSearchParameters \\(array\\<string, DCL\\\\Services\\\\Search\\\\ISearchField\\>\\) of method DCL\\\\Services\\\\FHIR\\\\Observation\\\\FhirObservationEmployerService\\:\\:searchForDCLRecords\\(\\) should be contravariant with parameter \\$DCLSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:searchForDCLRecords\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/Observation/FhirObservationEmployerService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$dataRecord \\(DCL\\\\FHIR\\\\R4\\\\FHIRResource\\\\FHIRDomainResource\\) of method DCL\\\\Services\\\\FHIR\\\\Observation\\\\FhirObservationHistorySdohService\\:\\:createProvenanceResource\\(\\) should be contravariant with parameter \\$dataRecord \\(mixed\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:createProvenanceResource\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/Observation/FhirObservationHistorySdohService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$DCLSearchParameters \\(array\\<string, DCL\\\\Services\\\\Search\\\\ISearchField\\>\\) of method DCL\\\\Services\\\\FHIR\\\\Observation\\\\FhirObservationHistorySdohService\\:\\:searchForDCLRecords\\(\\) should be contravariant with parameter \\$DCLSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:searchForDCLRecords\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/Observation/FhirObservationHistorySdohService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$DCLSearchParameters \\(array\\<string, DCL\\\\Services\\\\Search\\\\ISearchField\\>\\) of method DCL\\\\Services\\\\FHIR\\\\Observation\\\\FhirObservationLaboratoryService\\:\\:searchForDCLRecords\\(\\) should be contravariant with parameter \\$DCLSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:searchForDCLRecords\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/Observation/FhirObservationLaboratoryService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$dataRecord \\(DCL\\\\FHIR\\\\R4\\\\FHIRResource\\\\FHIRDomainResource\\) of method DCL\\\\Services\\\\FHIR\\\\Observation\\\\FhirObservationObservationFormService\\:\\:createProvenanceResource\\(\\) should be contravariant with parameter \\$dataRecord \\(mixed\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:createProvenanceResource\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/Observation/FhirObservationObservationFormService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$DCLSearchParameters \\(array\\<string, DCL\\\\Services\\\\Search\\\\ISearchField\\>\\) of method DCL\\\\Services\\\\FHIR\\\\Observation\\\\FhirObservationObservationFormService\\:\\:searchForDCLRecords\\(\\) should be contravariant with parameter \\$DCLSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:searchForDCLRecords\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/Observation/FhirObservationObservationFormService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$dataRecord \\(DCL\\\\FHIR\\\\R4\\\\FHIRResource\\\\FHIRDomainResource\\) of method DCL\\\\Services\\\\FHIR\\\\Observation\\\\FhirObservationPatientService\\:\\:createProvenanceResource\\(\\) should be contravariant with parameter \\$dataRecord \\(mixed\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:createProvenanceResource\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/Observation/FhirObservationPatientService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$DCLSearchParameters \\(array\\<string, DCL\\\\Services\\\\Search\\\\ISearchField\\>\\) of method DCL\\\\Services\\\\FHIR\\\\Observation\\\\FhirObservationPatientService\\:\\:searchForDCLRecords\\(\\) should be contravariant with parameter \\$DCLSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:searchForDCLRecords\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/Observation/FhirObservationPatientService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$dataRecord \\(DCL\\\\FHIR\\\\R4\\\\FHIRResource\\\\FHIRDomainResource\\) of method DCL\\\\Services\\\\FHIR\\\\Observation\\\\FhirObservationQuestionnaireItemService\\:\\:createProvenanceResource\\(\\) should be contravariant with parameter \\$dataRecord \\(mixed\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:createProvenanceResource\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/Observation/FhirObservationQuestionnaireItemService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$DCLSearchParameters \\(array\\<string, DCL\\\\Services\\\\Search\\\\ISearchField\\>\\) of method DCL\\\\Services\\\\FHIR\\\\Observation\\\\FhirObservationQuestionnaireItemService\\:\\:searchForDCLRecords\\(\\) should be contravariant with parameter \\$DCLSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:searchForDCLRecords\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/Observation/FhirObservationQuestionnaireItemService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$DCLSearchParameters \\(array\\<string, DCL\\\\Services\\\\FHIR\\\\Observation\\\\ISearchField\\>\\) of method DCL\\\\Services\\\\FHIR\\\\Observation\\\\FhirObservationSocialHistoryService\\:\\:searchForDCLRecords\\(\\) should be contravariant with parameter \\$DCLSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:searchForDCLRecords\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/Observation/FhirObservationSocialHistoryService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$dataRecord \\(array\\|DCL\\\\FHIR\\\\R4\\\\FHIRDomainResource\\\\FHIRObservation\\) of method DCL\\\\Services\\\\FHIR\\\\Observation\\\\FhirObservationVitalsService\\:\\:createProvenanceResource\\(\\) should be contravariant with parameter \\$dataRecord \\(mixed\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:createProvenanceResource\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/Observation/FhirObservationVitalsService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$DCLSearchParameters \\(array\\<string, DCL\\\\Services\\\\Search\\\\ISearchField\\>\\) of method DCL\\\\Services\\\\FHIR\\\\Observation\\\\FhirObservationVitalsService\\:\\:searchForDCLRecords\\(\\) should be contravariant with parameter \\$DCLSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:searchForDCLRecords\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/Observation/FhirObservationVitalsService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$DCLSearchParameters \\(array\\<string, DCL\\\\Services\\\\Search\\\\ISearchField\\>\\) of method DCL\\\\Services\\\\FHIR\\\\Organization\\\\FhirOrganizationFacilityService\\:\\:searchForDCLRecords\\(\\) should be contravariant with parameter \\$DCLSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:searchForDCLRecords\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/Organization/FhirOrganizationFacilityService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$fhirResource \\(array\\|DCL\\\\FHIR\\\\R4\\\\FHIRDomainResource\\\\FHIROrganization\\) of method DCL\\\\Services\\\\FHIR\\\\Organization\\\\FhirOrganizationInsuranceService\\:\\:parseFhirResource\\(\\) should be contravariant with parameter \\$fhirResource \\(DCL\\\\FHIR\\\\R4\\\\FHIRResource\\\\FHIRDomainResource\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:parseFhirResource\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/Organization/FhirOrganizationInsuranceService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$DCLSearchParameters \\(array\\<string, DCL\\\\Services\\\\Search\\\\ISearchField\\>\\) of method DCL\\\\Services\\\\FHIR\\\\Organization\\\\FhirOrganizationInsuranceService\\:\\:searchForDCLRecords\\(\\) should be contravariant with parameter \\$DCLSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:searchForDCLRecords\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/Organization/FhirOrganizationInsuranceService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$DCLSearchParameters \\(array\\<string, DCL\\\\Services\\\\Search\\\\ISearchField\\>\\) of method DCL\\\\Services\\\\FHIR\\\\Organization\\\\FhirOrganizationProcedureProviderService\\:\\:searchForDCLRecords\\(\\) should be contravariant with parameter \\$DCLSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:searchForDCLRecords\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/Organization/FhirOrganizationProcedureProviderService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$DCLSearchParameters \\(array\\<string, DCL\\\\Services\\\\Search\\\\ISearchField\\>\\) of method DCL\\\\Services\\\\FHIR\\\\Procedure\\\\FhirProcedureOEProcedureService\\:\\:searchForDCLRecords\\(\\) should be contravariant with parameter \\$DCLSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:searchForDCLRecords\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/Procedure/FhirProcedureOEProcedureService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$DCLSearchParameters \\(array\\<string, DCL\\\\Services\\\\Search\\\\ISearchField\\>\\) of method DCL\\\\Services\\\\FHIR\\\\Procedure\\\\FhirProcedureSurgeryService\\:\\:searchForDCLRecords\\(\\) should be contravariant with parameter \\$DCLSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:searchForDCLRecords\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/Procedure/FhirProcedureSurgeryService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$dataRecord \\(DCL\\\\FHIR\\\\R4\\\\FHIRResource\\\\FHIRDomainResource\\) of method DCL\\\\Services\\\\FHIR\\\\Questionnaire\\\\FhirQuestionnaireFormService\\:\\:createProvenanceResource\\(\\) should be contravariant with parameter \\$dataRecord \\(mixed\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:createProvenanceResource\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/Questionnaire/FhirQuestionnaireFormService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$DCLSearchParameters \\(array\\<string, DCL\\\\Services\\\\Search\\\\ISearchField\\>\\) of method DCL\\\\Services\\\\FHIR\\\\Questionnaire\\\\FhirQuestionnaireFormService\\:\\:searchForDCLRecords\\(\\) should be contravariant with parameter \\$DCLSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:searchForDCLRecords\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/Questionnaire/FhirQuestionnaireFormService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$dataRecord \\(DCL\\\\FHIR\\\\R4\\\\FHIRResource\\\\FHIRDomainResource\\) of method DCL\\\\Services\\\\FHIR\\\\QuestionnaireResponse\\\\FhirQuestionnaireResponseFormService\\:\\:createProvenanceResource\\(\\) should be contravariant with parameter \\$dataRecord \\(mixed\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:createProvenanceResource\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/QuestionnaireResponse/FhirQuestionnaireResponseFormService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#1 \\$DCLSearchParameters \\(array\\<string, DCL\\\\Services\\\\Search\\\\ISearchField\\>\\) of method DCL\\\\Services\\\\FHIR\\\\QuestionnaireResponse\\\\FhirQuestionnaireResponseFormService\\:\\:searchForDCLRecords\\(\\) should be contravariant with parameter \\$DCLSearchParameters \\(array\\) of method DCL\\\\Services\\\\FHIR\\\\FhirServiceBase\\:\\:searchForDCLRecords\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/FHIR/QuestionnaireResponse/FhirQuestionnaireResponseFormService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#2 \\$isAndCondition \\(bool\\) of method DCL\\\\Services\\\\ImmunizationService\\:\\:search\\(\\) should be contravariant with parameter \\$isAndCondition \\(mixed\\) of method DCL\\\\Services\\\\BaseServiceInterface\\:\\:search\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/ImmunizationService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#2 \\$isAndCondition \\(bool\\) of method DCL\\\\Services\\\\InsuranceCompanyService\\:\\:search\\(\\) should be contravariant with parameter \\$isAndCondition \\(mixed\\) of method DCL\\\\Services\\\\BaseServiceInterface\\:\\:search\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/InsuranceCompanyService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#2 \\$isAndCondition \\(bool\\) of method DCL\\\\Services\\\\InsuranceService\\:\\:search\\(\\) should be contravariant with parameter \\$isAndCondition \\(mixed\\) of method DCL\\\\Services\\\\BaseServiceInterface\\:\\:search\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/InsuranceService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#2 \\$isAndCondition \\(bool\\) of method DCL\\\\Services\\\\ObservationLabService\\:\\:search\\(\\) should be contravariant with parameter \\$isAndCondition \\(mixed\\) of method DCL\\\\Services\\\\BaseServiceInterface\\:\\:search\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/ObservationLabService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#2 \\$isAndCondition \\(bool\\) of method DCL\\\\Services\\\\ObservationService\\:\\:search\\(\\) should be contravariant with parameter \\$isAndCondition \\(mixed\\) of method DCL\\\\Services\\\\BaseServiceInterface\\:\\:search\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/ObservationService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#2 \\$isAndCondition \\(bool\\) of method DCL\\\\Services\\\\PatientAdvanceDirectiveService\\:\\:search\\(\\) should be contravariant with parameter \\$isAndCondition \\(mixed\\) of method DCL\\\\Services\\\\BaseServiceInterface\\:\\:search\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/PatientAdvanceDirectiveService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#2 \\$isAndCondition \\(bool\\) of method DCL\\\\Services\\\\PatientIssuesService\\:\\:search\\(\\) should be contravariant with parameter \\$isAndCondition \\(mixed\\) of method DCL\\\\Services\\\\BaseServiceInterface\\:\\:search\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/PatientIssuesService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#2 \\$isAndCondition \\(bool\\) of method DCL\\\\Services\\\\PatientService\\:\\:search\\(\\) should be contravariant with parameter \\$isAndCondition \\(mixed\\) of method DCL\\\\Services\\\\BaseServiceInterface\\:\\:search\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/PatientService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#2 \\$isAndCondition \\(bool\\) of method DCL\\\\Services\\\\PersonService\\:\\:search\\(\\) should be contravariant with parameter \\$isAndCondition \\(mixed\\) of method DCL\\\\Services\\\\BaseServiceInterface\\:\\:search\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/PersonService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#2 \\$isAndCondition \\(bool\\) of method DCL\\\\Services\\\\PractitionerRoleService\\:\\:search\\(\\) should be contravariant with parameter \\$isAndCondition \\(mixed\\) of method DCL\\\\Services\\\\BaseServiceInterface\\:\\:search\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/PractitionerRoleService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#2 \\$isAndCondition \\(bool\\) of method DCL\\\\Services\\\\PractitionerService\\:\\:search\\(\\) should be contravariant with parameter \\$isAndCondition \\(mixed\\) of method DCL\\\\Services\\\\BaseServiceInterface\\:\\:search\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/PractitionerService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#2 \\$isAndCondition \\(bool\\) of method DCL\\\\Services\\\\ProcedureProviderService\\:\\:search\\(\\) should be contravariant with parameter \\$isAndCondition \\(mixed\\) of method DCL\\\\Services\\\\BaseServiceInterface\\:\\:search\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/ProcedureProviderService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#2 \\$isAndCondition \\(bool\\) of method DCL\\\\Services\\\\ProcedureService\\:\\:search\\(\\) should be contravariant with parameter \\$isAndCondition \\(mixed\\) of method DCL\\\\Services\\\\BaseServiceInterface\\:\\:search\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/ProcedureService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#2 \\$isAndCondition \\(bool\\) of method DCL\\\\Services\\\\QuestionnaireResponseService\\:\\:search\\(\\) should be contravariant with parameter \\$isAndCondition \\(mixed\\) of method DCL\\\\Services\\\\BaseServiceInterface\\:\\:search\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/QuestionnaireResponseService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#2 \\$isAndCondition \\(bool\\) of method DCL\\\\Services\\\\SDOH\\\\HistorySdohService\\:\\:search\\(\\) should be contravariant with parameter \\$isAndCondition \\(mixed\\) of method DCL\\\\Services\\\\BaseServiceInterface\\:\\:search\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/SDOH/HistorySdohService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#2 \\$isAndCondition \\(bool\\) of method DCL\\\\Services\\\\SocialHistoryService\\:\\:search\\(\\) should be contravariant with parameter \\$isAndCondition \\(mixed\\) of method DCL\\\\Services\\\\BaseServiceInterface\\:\\:search\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/SocialHistoryService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#2 \\$isAndCondition \\(bool\\) of method DCL\\\\Services\\\\SurgeryService\\:\\:search\\(\\) should be contravariant with parameter \\$isAndCondition \\(mixed\\) of method DCL\\\\Services\\\\BaseServiceInterface\\:\\:search\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/SurgeryService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#2 \\$isAndCondition \\(bool\\) of method DCL\\\\Services\\\\VitalsCalculatedService\\:\\:search\\(\\) should be contravariant with parameter \\$isAndCondition \\(mixed\\) of method DCL\\\\Services\\\\BaseServiceInterface\\:\\:search\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/VitalsCalculatedService.php',
];
$ignoreErrors[] = [
    'message' => '#^Parameter \\#2 \\$isAndCondition \\(bool\\) of method DCL\\\\Services\\\\VitalsService\\:\\:search\\(\\) should be contravariant with parameter \\$isAndCondition \\(mixed\\) of method DCL\\\\Services\\\\BaseServiceInterface\\:\\:search\\(\\)$#',
    'count' => 1,
    'path' => __DIR__ . '/../../src/Services/VitalsService.php',
];

return ['parameters' => ['ignoreErrors' => $ignoreErrors]];

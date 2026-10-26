<?php

/**
 * FhirOperationDocRefRestController handles the creation / retrieve of Clinical Summary of Care (CCD) documents for a patient.
 *
 * @package DCL
 * @link      https://www.dcl.org
 * @author    Stephen Nielson <snielson@discoverandchange.com>
 * @copyright Copyright (c) 2022 Discover and Change <snielson@discoverandchange.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\RestControllers\FHIR\Operations;

use OpenApi\Attributes as OA;
use DCL\BC\ServiceContainer;
use DCL\Common\Http\HttpRestRequest;
use DCL\Common\Http\Psr17Factory;
use DCL\Common\Http\StatusCode;
use DCL\Core\OEGlobalsBag;
use DCL\FHIR\R4\FHIRDomainResource\FHIROperationOutcome;
use DCL\FHIR\R4\FHIRElement\FHIRCodeableConcept;
use DCL\FHIR\R4\FHIRElement\FHIRIssueSeverity;
use DCL\FHIR\R4\FHIRElement\FHIRIssueType;
use DCL\FHIR\R4\FHIRResource\FHIRBundle\FHIRBundleEntry;
use DCL\FHIR\R4\FHIRResource\FHIROperationOutcome\FHIROperationOutcomeIssue;
use DCL\Services\FHIR\FhirDocRefService;
use DCL\Services\FHIR\FhirResourcesService;
use DCL\Services\Search\SearchFieldException;
use Ramsey\Uuid\Uuid;

class FhirOperationDocRefRestController
{
    const OPERATION_OUTCOME_ISSUE_TYPE_PROCESSING = "processing";
    const OPERATION_OUTCOME_ISSUE_TYPE_NOT_SUPPORTED = "not-supported";

    private readonly FhirDocRefService $fhirDocRefService;
    private readonly FhirResourcesService $fhirService;

    public function __construct(HttpRestRequest $request)
    {
        $this->fhirDocRefService = new FhirDocRefService($request->getApiBaseFullUrl());
        $this->fhirService = new FhirResourcesService();
    }

    /**
     * Queries for FHIR location resources using various search parameters.
     * @param $puuidBind - Optional variable to only allow visibility of the patient with this puuid.
     * @return \Psr\Http\Message\ResponseInterface FHIR bundle with query results, if found
     */
    #[OA\Post(
        path: '/fhir/DocumentReference/$docref',
        description: "The \$docref operation is used to request the server generates a document based on the specified parameters. If no additional parameters are specified then a DocumentReference to the patient's most current Clinical Summary of Care Document (CCD) is returned. The document itself is retrieved using the DocumentReference.content.attachment.url element.  See <a href='http://hl7.org/fhir/us/core/OperationDefinition-docref.html' target='_blank' rel='noopener'>http://hl7.org/fhir/us/core/OperationDefinition-docref.html</a> for more details.",
        tags: ['fhir'],
        externalDocs: new OA\ExternalDocumentation(
            description: 'Detailed documentation on this operation',
            url: 'https://www.dcl.org/wiki/index.php/DCL_Wiki_Home_Page#API'
        ),
        parameters: [
            new OA\Parameter(
                name: 'patient',
                in: 'query',
                description: 'The uuid for the patient.',
                required: true,
                schema: new OA\Schema(type: 'string')
            ),
            new OA\Parameter(
                name: 'start',
                in: 'query',
                description: 'The datetime refers to care dates not record currency dates.  All records relating to care provided in a certain date range.  If no start date is provided then all documents prior to the end date are in scope.  If no start and end date are provided, the most recent or current document is in scope.',
                required: false,
                schema: new OA\Schema(type: 'string')
            ),
            new OA\Parameter(
                name: 'end',
                in: 'query',
                description: 'The datetime refers to care dates not record currency dates.  All records relating to care provided in a certain date range.  If no end date is provided then all documents subsequent to the start date are in scope.  If no start and end date are provided, the most recent or current document is in scope.',
                required: false,
                schema: new OA\Schema(type: 'string')
            ),
            new OA\Parameter(
                name: 'type',
                in: 'query',
                description: "The type refers to the document type.  This is a LOINC code from the valueset of <a href='http://hl7.org/fhir/R4/valueset-c80-doc-typecodes.html' target='_blank' rel='noopener'>http://hl7.org/fhir/R4/valueset-c80-doc-typecodes.html</a>. The server currently only supports the LOINC code of 34133-9 (Summary of episode node).",
                required: false,
                schema: new OA\Schema(type: 'string')
            ),
        ],
        responses: [
            new OA\Response(response: '200', description: 'A search bundle of DocumentReferences is returned'),
            new OA\Response(response: '400', ref: '#/components/responses/badrequest'),
            new OA\Response(response: '401', ref: '#/components/responses/unauthorized'),
        ],
        security: [['DCL_auth' => []]]
    )]
    public function getAll($searchParams, $puuidBind = null)
    {
        try {
            $processingResult = $this->fhirDocRefService->getAll($searchParams, $puuidBind);
            $bundleEntries = [];
            foreach ($processingResult->getData() as $searchResult) {
                // we actually need to truncate off the operation
                $bundleEntry = [
                    'fullUrl' => OEGlobalsBag::getInstance()->get('site_addr_oath') . ($_SERVER['REDIRECT_URL'] ?? '') . '/' . $searchResult->getId(),
                    'resource' => $searchResult
                ];
                $fhirBundleEntry = new FHIRBundleEntry($bundleEntry);
                array_push($bundleEntries, $fhirBundleEntry);
            }
            $bundleSearchResult = $this->fhirService->createBundle('DocumentReference', $bundleEntries, false);
            $response = $this->createResponseForCode(StatusCode::OK);
            $response->getBody()->write(json_encode($bundleSearchResult, JSON_THROW_ON_ERROR));
        } catch (SearchFieldException $exception) {
            $systemLogger = ServiceContainer::getLogger();
            $systemLogger->error(static::class . "->getAll() exception thrown", ['message' => $exception->getMessage(),
                'field' => $exception->getField(), 'trace' => $exception->getTraceAsString()]);
            // put our exception information here
            $operationOutcome = $this->createOperationOutcomeError($exception->getMessage(), self::OPERATION_OUTCOME_ISSUE_TYPE_PROCESSING);
            $response = $this->createResponseForCode(StatusCode::BAD_REQUEST);
            $response->getBody()->write(json_encode($operationOutcome, JSON_THROW_ON_ERROR));
        } catch (\Throwable $exception) {
            $response = $this->createResponseForCode(StatusCode::BAD_REQUEST);
            $operationOutcome = $this->createOperationOutcomeError($exception->getMessage(), self::OPERATION_OUTCOME_ISSUE_TYPE_PROCESSING);
            $response->getBody()->write(json_encode($operationOutcome, JSON_THROW_ON_ERROR));
        }

        return $response;
    }



    /**
     * Create a response object for the given status code with our default set of headers.
     * @param $statusCode
     * @return \Psr\Http\Message\ResponseInterface
     */
    private function createResponseForCode($statusCode)
    {
        $response = (new Psr17Factory())->createResponse($statusCode);
        return $response->withAddedHeader('Content-Type', 'application/json');
    }

    /**
     * Given an error outcome text create a Fhir Outcome issue for the error and return it.
     * @param $text
     */
    private function createOperationOutcomeError($text, $type): FHIROperationOutcome
    {
        $issue = new FHIROperationOutcomeIssue();
        $issueType = new FHIRIssueType();
        $issueType->setValue("processing");
        $issueSeverity = new FHIRIssueSeverity();
        $issueSeverity->setValue("error");
        $issue->setSeverity($issueSeverity);
        $issue->setCode($issueType);
        $details = new FHIRCodeableConcept();
        $details->setText($text);
        $issue->setDetails($details);
        $operationOutcome = new FHIROperationOutcome();
        $operationOutcome->setId(Uuid::uuid4()); // not sure we care about storing these
        $operationOutcome->addIssue($issue);
        return $operationOutcome;
    }
}

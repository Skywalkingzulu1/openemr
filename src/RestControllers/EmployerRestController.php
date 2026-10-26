<?php

/**
 * EmployerRestController handles the API rest requests to the employer data for a patient
 *
 * @package DCL
 * @link      https://www.dcl.org
 * @author    Stephen Nielson <snielson@discoverandchange.com>
 * @copyright Copyright (c) 2024 Care Management Solutions, Inc. <stephen.waite@cmsvt.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\RestControllers;

use OpenApi\Attributes as OA;
use DCL\Common\Http\HttpRestRequest;
use DCL\Services\EmployerService;
use DCL\Services\Search\DateSearchField;
use DCL\Services\Search\SearchFieldException;
use DCL\Services\Search\SearchModifier;
use DCL\Services\Search\StringSearchField;
use DCL\Services\Search\TokenSearchField;
use DCL\Validators\ProcessingResult;
use Psr\Http\Message\ResponseInterface;

class EmployerRestController
{
    private readonly EmployerService $employerService;

    public function __construct()
    {
        $this->employerService = new EmployerService();
    }

    /**
     * Retrieves all employer data for a patient.
     * @param array<string, mixed> $searchParams - Search parameters including puuid.
     */
    #[OA\Get(
        path: '/api/patient/{puuid}/employer',
        description: 'Retrieves all the employer data for a patient. Returns an array of the employer data for the patient.',
        tags: ['standard'],
        parameters: [
            new OA\Parameter(
                name: 'pid',
                in: 'path',
                description: 'The uuid for the patient.',
                required: true,
                schema: new OA\Schema(type: 'string')
            ),
            new OA\Parameter(name: 'name', in: 'query', description: 'Partial match on the employer name.', required: false, schema: new OA\Schema(type: 'string')),
            new OA\Parameter(name: 'occupation', in: 'query', description: 'The ODH occupation code.', required: false, schema: new OA\Schema(type: 'string')),
            new OA\Parameter(name: 'industry', in: 'query', description: 'The ODH industry code.', required: false, schema: new OA\Schema(type: 'string')),
            new OA\Parameter(name: 'start_date', in: 'query', description: 'The employment start date, supports FHIR prefixes e.g. ge2024-01-01.', required: false, schema: new OA\Schema(type: 'string')),
            new OA\Parameter(name: 'end_date', in: 'query', description: 'The employment end date, supports FHIR prefixes e.g. lt2025-01-01.', required: false, schema: new OA\Schema(type: 'string')),
        ],
        responses: [
            new OA\Response(response: '200', ref: '#/components/responses/standard'),
            new OA\Response(response: '400', ref: '#/components/responses/badrequest'),
            new OA\Response(response: '401', ref: '#/components/responses/unauthorized'),
        ],
        security: [['DCL_auth' => ['user/employer.read', 'patient/employer.read']]]
    )]
    public function getAll(HttpRestRequest $request, array $searchParams): ResponseInterface
    {
        $processingResult = new ProcessingResult();
        try {
            $search = [];
            foreach ($searchParams as $key => $value) {
                if (!is_string($value) && !is_array($value)) {
                    throw new SearchFieldException('search', 'unsupported search parameter');
                }
                $search[$key] = match ($key) {
                    'id' => new TokenSearchField('id', $value, false),
                    'puuid' => new TokenSearchField('puuid', $value, true),
                    'pid' => new TokenSearchField('pid', $value, true),
                    'name' => new StringSearchField('name', $value, SearchModifier::CONTAINS),
                    'occupation', 'industry' => new TokenSearchField($key, $value),
                    'start_date', 'end_date' => new DateSearchField($key, $value, DateSearchField::DATE_TYPE_DATETIME),
                    default => throw new SearchFieldException('search', 'unsupported search parameter'),
                };
            }
            $processingResult = $this->employerService->search($search);
        } catch (SearchFieldException | \InvalidArgumentException) {
            // do not reflect raw parameter names or values back to the caller
            $processingResult->setValidationMessages(['search' => ['invalid or unsupported search parameter']]);
        }
        return RestControllerHelper::createProcessingResultResponse($request, $processingResult, 200, true);
    }
}

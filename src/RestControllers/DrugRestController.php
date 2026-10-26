<?php

/**
 * DrugRestController
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Yash Bothra <yashrajbothra786gmail.com>
 * @copyright Copyright (c) 2020 Yash Bothra <yashrajbothra786gmail.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\RestControllers;

use OpenApi\Attributes as OA;
use DCL\RestControllers\RestControllerHelper;
use DCL\Services\DrugService;

class DrugRestController
{
    private $drugService;

    public function __construct()
    {
        $this->drugService = new DrugService();
    }

    /**
     * Fetches a single drug resource by id.
     * @param $uuid- The drug uuid identifier in string format.
     */
    #[OA\Get(
        path: '/api/drug/{uuid}',
        description: 'Retrieves a drug',
        tags: ['standard'],
        parameters: [
            new OA\Parameter(
                name: 'uuid',
                in: 'path',
                description: 'The uuid for the drug.',
                required: true,
                schema: new OA\Schema(type: 'string')
            ),
        ],
        responses: [
            new OA\Response(response: '200', ref: '#/components/responses/standard'),
            new OA\Response(response: '400', ref: '#/components/responses/badrequest'),
            new OA\Response(response: '401', ref: '#/components/responses/unauthorized'),
            new OA\Response(response: '404', ref: '#/components/responses/standard'),
        ],
        security: [['DCL_auth' => []]]
    )]
    public function getOne($uuid)
    {
        $processingResult = $this->drugService->getOne($uuid);

        if (!$processingResult->hasErrors() && count($processingResult->getData()) == 0) {
            return RestControllerHelper::handleProcessingResult($processingResult, 404);
        }

        return RestControllerHelper::handleProcessingResult($processingResult, 200);
    }

    /**
     * Returns drug resources which match an optional search criteria.
     */
    #[OA\Get(
        path: '/api/drug',
        description: 'Retrieves a list of all drugs',
        tags: ['standard'],
        responses: [
            new OA\Response(response: '200', ref: '#/components/responses/standard'),
            new OA\Response(response: '400', ref: '#/components/responses/badrequest'),
            new OA\Response(response: '401', ref: '#/components/responses/unauthorized'),
        ],
        security: [['DCL_auth' => []]]
    )]
    public function getAll($search = [])
    {
        $processingResult = $this->drugService->getAll($search);
        return RestControllerHelper::handleProcessingResult($processingResult, 200, true);
    }
}

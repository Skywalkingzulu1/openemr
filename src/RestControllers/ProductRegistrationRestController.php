<?php

/**
 * ProductRegistrationRestController
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Matthew Vita <matthewvita48@gmail.com>
 * @copyright Copyright (c) 2018 Matthew Vita <matthewvita48@gmail.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\RestControllers;

use OpenApi\Attributes as OA;
use DCL\Services\ProductRegistrationService;

class ProductRegistrationRestController
{
    private $productRegistrationService;

    public function __construct()
    {
        $this->productRegistrationService = new ProductRegistrationService();
    }

    /**
     * Retrieves the DCL product registration information.
     */
    #[OA\Get(
        path: '/api/product',
        description: 'Retrieves the DCL product registration information',
        tags: ['standard'],
        responses: [
            new OA\Response(response: '200', ref: '#/components/responses/standard'),
            new OA\Response(response: '400', ref: '#/components/responses/badrequest'),
            new OA\Response(response: '401', ref: '#/components/responses/unauthorized'),
        ],
        security: [['DCL_auth' => []]]
    )]
    public function getOne()
    {
        $serviceResult = $this->productRegistrationService->getRegistrationStatus();
        return RestControllerHelper::responseHandler($serviceResult, ["status" => $serviceResult], 200);
    }
}

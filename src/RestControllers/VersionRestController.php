<?php

/**
 * VersionRestController
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Matthew Vita <matthewvita48@gmail.com>
 * @copyright Copyright (c) 2018 Matthew Vita <matthewvita48@gmail.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\RestControllers;

use OpenApi\Attributes as OA;
use DCL\RestControllers\RestControllerHelper;
use DCL\Services\VersionService;

class VersionRestController
{
    private $versionService;

    public function __construct()
    {
        $this->versionService = new VersionService();
    }

    /**
     * Retrieves the DCL version information.
     */
    #[OA\Get(
        path: '/api/version',
        description: 'Retrieves the DCL version information',
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
        $serviceResult = $this->versionService->fetch();
        return RestControllerHelper::responseHandler($serviceResult, null, 200);
    }
}

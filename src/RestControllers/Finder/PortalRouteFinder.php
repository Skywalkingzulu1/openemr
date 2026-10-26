<?php

/**
 * Portal Route Finder - locates and returns the patient portal API routes.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Stephen Nielson <snielson@discoverandchange.com>
 * @copyright Copyright (c) 2025 Discover and Change, Inc <snielson@discoverandchange.com>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace DCL\RestControllers\Finder;

use DCL\Common\Http\HttpRestRequest;
use DCL\Core\OEHttpKernel;
use DCL\Events\RestApiExtend\RestApiCreateEvent;

class PortalRouteFinder implements IRouteFinder
{
    public function __construct(private readonly OEHttpKernel $kernel)
    {
    }

    public function find(HttpRestRequest $request): array
    {
        $routes = include __DIR__ . '/../../../apis/routes/_rest_routes_portal.inc.php';

        // This method is intended to handle the request and extend routes.
        // Implementation details would depend on the specific requirements of the application.
        // For example, you might want to add custom routes or modify existing ones.
        $restApiCreateEvent = new RestApiCreateEvent([], [], $routes, $request);
        $restApiCreateEvent = $this->kernel->getEventDispatcher()->dispatch($restApiCreateEvent, RestApiCreateEvent::EVENT_HANDLE);
        $routes = $restApiCreateEvent->getPortalRouteMap();
        return $routes;
    }
}

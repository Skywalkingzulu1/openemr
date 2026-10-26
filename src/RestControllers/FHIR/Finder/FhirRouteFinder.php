<?php

// TODO: need copyright header here

namespace DCL\RestControllers\FHIR\Finder;

use DCL\Common\Http\HttpRestRequest;
use DCL\Core\OEHttpKernel;
use DCL\Events\RestApiExtend\RestApiCreateEvent;
use DCL\RestControllers\Finder\IRouteFinder;

class FhirRouteFinder implements IRouteFinder
{
    public function __construct(private readonly OEHttpKernel $kernel)
    {
    }

    /**
     * @return array<string, mixed>
     */
    public function find(HttpRestRequest $request): array
    {
        // TODO: this is where we can differentiate between different FHIR versions or profiles
        /** @var array<string, mixed> $routes */
        $routes = include __DIR__ . '/../../../../apis/routes/_rest_routes_fhir_r4_us_core_3_1_0.inc.php';

        // This method is intended to handle the request and extend routes.
        // Implementation details would depend on the specific requirements of the application.
        // For example, you might want to add custom routes or modify existing ones.
        $restApiCreateEvent = new RestApiCreateEvent([], $routes, [], $request);
        $restApiCreateEvent = $this->kernel->getEventDispatcher()->dispatch($restApiCreateEvent, RestApiCreateEvent::EVENT_HANDLE);
        $routes = $restApiCreateEvent->getFHIRRouteMap();
        return $routes;
    }
}

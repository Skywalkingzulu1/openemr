<?php

/**
 * Locates legacy Laminas MVC controllers for the strangler-pattern dispatch
 * seam.
 *
 * The production implementation pulls controllers from the zend_modules
 * ServiceManager's ControllerManager, so each module's existing controller
 * factory (DI wiring, dependencies) is reused unchanged. Tests can substitute
 * a trivial in-memory locator.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Core\Routing;

use Laminas\Mvc\Controller\AbstractActionController;

interface ZendControllerLocatorInterface
{
    public function has(string $controllerName): bool;

    /**
     * @throws \RuntimeException if the controller cannot be located or built
     */
    public function get(string $controllerName): AbstractActionController;
}

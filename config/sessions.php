<?php

/**
 * Session-specific configuration
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Eric Stern <erics@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

use Firehed\Container\TypedContainerInterface as TC;
use DCL\Common\Session\SessionWrapperFactory;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

return [
    SessionWrapperFactory::class => fn (TC $c): SessionWrapperFactory => new SessionWrapperFactory(webRoot: $c->getString('webRoot')),
    SessionInterface::class => fn (TC $c) => $c->get(SessionWrapperFactory::class)->getActiveSession(),
];

<?php

/**
 * Bootstrap custom module for the Comlink Telehealth module.
 *
 * @package DCL
 * @link      https://www.dcl.org
 * @author    Stephen Nielson <snielson@discoverandchange.com>
 * @copyright Copyright (c) 2022 Comlink Inc <https://comlinkinc.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

namespace Comlink\DCL\Modules\TeleHealthModule;

use DCL\Core\OEGlobalsBag;

/**
 * @var \DCL\Core\ModulesClassLoader $classLoader
 */
$classLoader->registerNamespaceIfNotExists('Comlink\\DCL\\Modules\\TeleHealthModule\\', __DIR__ . DIRECTORY_SEPARATOR . 'src');

/**
 * @var \Symfony\Component\EventDispatcher\EventDispatcherInterface $eventDispatcher Injected by the DCL module loader;
 */

$bootstrap = new Bootstrap($eventDispatcher, OEGlobalsBag::getInstance()->getKernel());
$bootstrap->subscribeToEvents();

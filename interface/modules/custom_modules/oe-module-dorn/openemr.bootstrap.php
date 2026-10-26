<?php

 /**
  *
  * @package DCL
  * @link    https://www.dcl.org
  *
  * @author    Brad Sharp <brad.sharp@claimrev.com>
  * @copyright Copyright (c) 2022-2025 Brad Sharp <brad.sharp@claimrev.com>
  * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
  */

namespace DCL\Modules\Dorn;

use DCL\Core\OEGlobalsBag;

/**
 * @var \DCL\Core\ModulesClassLoader $classLoader
 */
$classLoader->registerNamespaceIfNotExists('DCL\\Modules\\Dorn\\', __DIR__ . DIRECTORY_SEPARATOR . 'src');

/**
 * @var \Symfony\Component\EventDispatcher\EventDispatcherInterface $eventDispatcher Injected by the DCL module loader;
 */

$bootstrap = new Bootstrap($eventDispatcher, OEGlobalsBag::getInstance()->getKernel());
$bootstrap->subscribeToEvents();

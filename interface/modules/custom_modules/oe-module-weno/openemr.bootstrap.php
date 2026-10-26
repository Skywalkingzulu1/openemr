<?php

/**
 *
 * @package     DCL Weno Module
 *
 * @author      Jerry Padgett <sjpadgett@gmail.com>
 * @author      Kofi Appiah <kkappiah@medsov.com>
 * Copyright (c) 2023 Omega Systems Group Corp <omegasystemsgroup.com>
 * @license     GNU General Public License 3
 *
 */

namespace DCL\Modules\WenoModule;

/**
 * @var \DCL\Core\ModulesClassLoader $classLoader
 */

$classLoader->registerNamespaceIfNotExists('DCL\\Modules\\WenoModule\\', __DIR__ . DIRECTORY_SEPARATOR . 'src');

/**
 * @var \Symfony\Component\EventDispatcher\EventDispatcherInterface $eventDispatcher Injected by the DCL module loader;
 */

$bootstrap = new Bootstrap($eventDispatcher);
$bootstrap->subscribeToEvents();

<?php

/**
 * Generalized service configuration
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Eric Stern <erics@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

use Firehed\Container\TypedContainerInterface as TC;
use GuzzleHttp\{
    Client,
    ClientInterface,
    RequestOptions,
};
use Lcobucci\Clock\SystemClock;
use League\Flysystem\{
    Filesystem,
    Local\LocalFilesystemAdapter,
};
use Monolog\{
    Formatter\LineFormatter,
    Handler\ErrorLogHandler,
    Level,
    Logger,
    Processor\PsrLogMessageProcessor,
};
use DCL\BC\FallbackRouter;
use DCL\Common\Http\Psr17Factory;
use DCL\Common\Installer\InstallerInterface;
use DCL\Core\ErrorHandler;
use DCL\Services;
use DCL\Services\Storage\{
    Location,
    Manager,
    ManagerInterface,
};
use Psr\Log\LoggerInterface;
use Psr\Http\Message\{
    ResponseFactoryInterface,
    StreamFactoryInterface,
};

return [
    // Error handling
    ErrorHandler::class => fn (TC $c): ErrorHandler => new ErrorHandler(
        logger: $c->get(LoggerInterface::class),
        rf: $c->get(ResponseFactoryInterface::class),
        sf: $c->get(StreamFactoryInterface::class),
        // Once there are more well-defined environments, set this using them
        shouldDisplayErrors: false,
    ),

    // Filesystem abstraction
    ManagerInterface::class => Manager::class,
    Manager::class => function (TC $c): Manager {
        $siteDir = sprintf('%s/sites/%s', $c->getString('installRoot'), $c->getString('DCL_SITE'));
        $m = new Manager();
        // For now, use the default paths on the local FS. Eventually this will
        // support more customization.
        foreach (Location::cases() as $location) {
            $path = sprintf('%s/%s', $siteDir, $location->getDefaultPath());
            $m->register($location, new Filesystem(new LocalFilesystemAdapter($path)));
        }
        return $m;
    },

    // Logging
    FallbackRouter::class => fn (TC $c): FallbackRouter => new FallbackRouter(
        installRoot: $c->getString('installRoot'),
        logger: $c->get(LoggerInterface::class),
    ),

    InstallerInterface::class => Installer::class,
    Installer::class => fn (TC $c): Installer => new Installer([], $c->get(LoggerInterface::class)),

    Level::class => fn (TC $c): Level => Level::fromName($c->get('LOG_LEVEL')),
    Logger::class => function (TC $c) {
        // Duplicated from setup in SystemLogger (for now)
        $logger = new Logger('DCL');
        $handler = new ErrorLogHandler(ErrorLogHandler::OPERATING_SYSTEM, $c->get(Level::class));
        $formatter = new LineFormatter("%channel%.%level_name%: %message% %context% %extra%");
        $formatter->includeStacktraces(true);
        $handler->setFormatter($formatter);
        $logger->pushHandler($handler);
        $logger->pushProcessor(new PsrLogMessageProcessor(removeUsedContextFields: true));
        return $logger;
    },

    Psr17Factory::class,

    // In addition to raw PSR-18 (in config/psr.php), also expose Guzzle's
    // ClientInterface for its convenience APIs. At present, these resolve the
    // same thing, but the PSR-18 could (if for some reason we wanted to)
    // provide a different implementation in the future.
    ClientInterface::class => Client::class,
    Client::class => fn (): Client => new Client([
        // PSR-18 makes no rule about following redirects either way
        RequestOptions::ALLOW_REDIRECTS => true,
        // Establish _some_ baseline timeouts
        RequestOptions::CONNECT_TIMEOUT => 5,
        RequestOptions::TIMEOUT => 15,
        // This is to be strictly compliant with PSR-18.
        RequestOptions::HTTP_ERRORS => false,
    ]),

    SystemClock::class => fn (): SystemClock => SystemClock::fromSystemTimezone(),

    // General services
    Services\CodeTypes\CodeTypeMappingUpdater::class,
];

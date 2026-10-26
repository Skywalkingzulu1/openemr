<?php

/**
 * Child-process fixture for PortalPatientAccessGuard denial behavior.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Jerry Padgett <sjpadgett@gmail.com>
 * @copyright Copyright (c) 2026 Jerry Padgett
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\BC {
    final class PortalGuardTestLogger
    {
        /** @param array<string, mixed> $context */
        public function warning(string $message, array $context = []): void
        {
        }
    }

    final class ServiceContainer
    {
        public static function getLogger(): PortalGuardTestLogger
        {
            return new PortalGuardTestLogger();
        }
    }
}

namespace DCL\Common\Logging {
    final class EventAuditLogger
    {
        public static function getInstance(): self
        {
            return new self();
        }

        public function newEvent(mixed ...$arguments): void
        {
        }
    }
}

namespace {
    use DCL\Common\Session\PortalPatientAccessGuard;
    use DCL\Common\Session\SessionWrapperFactory;
    use DCL\Core\OEGlobalsBag;
    use Symfony\Component\HttpFoundation\Session\Session;
    use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;

    require_once dirname(__DIR__, 6) . '/vendor/autoload.php';

    // Keep the real xlt()/xl() response path while preventing this isolated
    // child process from attempting a translation database lookup.
    $GLOBALS['disable_translation'] = true;

    $sessionPid = filter_var($argv[1] ?? null, FILTER_VALIDATE_INT);
    $requestedPid = filter_var($argv[2] ?? null, FILTER_VALIDATE_INT);
    if ($sessionPid === false || $requestedPid === false) {
        fwrite(STDERR, "Expected session and requested patient IDs.\n");
        exit(2);
    }

    $session = new Session(new MockArraySessionStorage());
    $session->set('patient_portal_onsite_two', true);
    SessionWrapperFactory::getInstance()->setActiveSession($session);
    OEGlobalsBag::getInstance()->set('bootstrap_pid', $sessionPid);

    PortalPatientAccessGuard::assertCanRead($requestedPid);
}

<?php

/**
 * Tests for portal patient and clinic staff demographic authorization.
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Jerry Padgett <sjpadgett@gmail.com>
 * @copyright Copyright (c) 2026 Jerry Padgett
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Tests\Isolated\Common\Session;

use DCL\Common\Session\PortalPatientAccessGuard;
use DCL\Common\Session\SessionWrapperFactory;
use DCL\Core\OEGlobalsBag;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

final class PortalPatientAccessGuardTest extends TestCase
{
    private SessionWrapperFactory $factory;
    private ?SessionInterface $savedSession = null;
    private bool $hadBootstrapPid = false;
    private mixed $savedBootstrapPid = null;

    protected function setUp(): void
    {
        $this->factory = SessionWrapperFactory::getInstance();
        $reflection = new \ReflectionClass($this->factory);
        $sessionProperty = $reflection->getProperty('activeSession');
        $activeSession = $sessionProperty->getValue($this->factory);
        $this->savedSession = $activeSession instanceof SessionInterface ? $activeSession : null;

        $this->hadBootstrapPid = array_key_exists('bootstrap_pid', $GLOBALS);
        $this->savedBootstrapPid = $GLOBALS['bootstrap_pid'] ?? null;
    }

    protected function tearDown(): void
    {
        $reflection = new \ReflectionClass($this->factory);
        $sessionProperty = $reflection->getProperty('activeSession');
        $sessionProperty->setValue($this->factory, $this->savedSession);

        if ($this->hadBootstrapPid) {
            $GLOBALS['bootstrap_pid'] = $this->savedBootstrapPid;
        } else {
            unset($GLOBALS['bootstrap_pid']);
        }
    }

    public function testPortalPatientCanReadOwnRecord(): void
    {
        $this->configurePortalSession(11);

        PortalPatientAccessGuard::assertCanRead(11);
        $this->addToAssertionCount(1);
    }

    public function testPortalPatientCanWriteOwnRecord(): void
    {
        $this->configurePortalSession(11);

        PortalPatientAccessGuard::assertCanWrite('11');
        $this->addToAssertionCount(1);
    }

    #[DataProvider('staffAccessCases')]
    public function testStaffAccessPredicate(bool $portalAccess, bool $demographicsAccess, bool $expected): void
    {
        $this->assertSame(
            $expected,
            PortalPatientAccessGuard::isStaffAccessAllowed($portalAccess, $demographicsAccess),
        );
    }

    /**
     * @return array<string, array{bool, bool, bool}>
     */
    public static function staffAccessCases(): array
    {
        return [
            'both ACLs granted' => [true, true, true],
            'portal ACL missing' => [false, true, false],
            'demographics ACL missing' => [true, false, false],
            'both ACLs missing' => [false, false, false],
        ];
    }

    private function configurePortalSession(int $pid): void
    {
        $session = $this->createMock(SessionInterface::class);
        $session->method('has')
            ->willReturnCallback(static fn (string $key): bool => $key === 'patient_portal_onsite_two');
        $this->factory->setActiveSession($session);
        OEGlobalsBag::getInstance()->set('bootstrap_pid', $pid);
    }
}

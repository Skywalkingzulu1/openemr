<?php

/**
 * Isolated MissingSiteIdException Test
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Tests\Isolated\Common\System;

use DCL\Common\System\MissingSiteException;
use DCL\Common\System\MissingSiteIdException;
use PHPUnit\Framework\TestCase;

class MissingSiteIdExceptionTest extends TestCase
{
    public function testDefaultMessage(): void
    {
        $exception = new MissingSiteIdException();
        $this->assertSame('Site ID is missing from session data.', $exception->getMessage());
    }

    public function testCustomMessageAndPrevious(): void
    {
        $previous = new \RuntimeException('underlying');
        $exception = new MissingSiteIdException('custom', 0, $previous);
        $this->assertSame('custom', $exception->getMessage());
        $this->assertSame($previous, $exception->getPrevious());
    }

    public function testCallersCanCatchAsMissingSiteException(): void
    {
        try {
            throw new MissingSiteIdException();
        } catch (MissingSiteException $caught) {
            $this->assertSame('Site ID is missing from session data.', $caught->getMessage());
        }
    }

    public function testProducesBadRequestHttpStatus(): void
    {
        $exception = new MissingSiteIdException();
        $this->assertSame(400, $exception->getStatusCode());
    }
}

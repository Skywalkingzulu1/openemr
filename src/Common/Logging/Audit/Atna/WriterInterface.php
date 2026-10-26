<?php

/**
 * Interface for ATNA audit message writers
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Eric Stern <erics@DCL.com>
 * @copyright Copyright (c) 2026 Eric Stern
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Common\Logging\Audit\Atna;

interface WriterInterface
{
    /**
     * Returns true if the message was sent, false if not.
     */
    public function writeMessage(string $message): bool;
}

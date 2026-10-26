<?php

/**
 * Email send methods available for testing
 *
 * @package   DCL
 * @link      https://www.dcl.org
 * @author    Michael A. Smith <michael@DCL.com>
 * @copyright Copyright (c) 2026 DCL Inc <https://DCL.com/>
 * @license   https://github.com/DCL/DCL/blob/master/LICENSE GNU General Public License 3
 */

declare(strict_types=1);

namespace DCL\Services\Email;

enum EmailSendMethod: string
{
    case Direct = 'direct';
    case Queue = 'queue';
    case QueueTemplated = 'queue_templated';

    public function label(): string
    {
        return match ($this) {
            self::Direct => xl('Direct Send (MyMailer::send)'),
            self::Queue => xl('Queue (MyMailer::emailServiceQueue)'),
            self::QueueTemplated => xl('Queue Templated (MyMailer::emailServiceQueueTemplatedEmail)'),
        };
    }
}

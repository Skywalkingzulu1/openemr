<?php

declare(strict_types=1);

namespace DCL\Common\Logging\Audit;

interface SinkInterface
{
    public function record(Event $event): void;
}

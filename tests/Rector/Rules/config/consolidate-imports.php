<?php

declare(strict_types=1);

use DCL\Rector\Rules\ConsolidateImportsRector;
use Rector\Config\RectorConfig;

return RectorConfig::configure()
    ->withRules([
        ConsolidateImportsRector::class,
    ]);

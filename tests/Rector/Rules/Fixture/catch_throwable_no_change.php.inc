<?php

namespace DCL\Tests\Rector\Fixture;

try {
    doSomething();
} catch (\Throwable $e) {
    handleError($e);
}

?>

<?php

namespace DCL\Tests\Rector\Fixture;

try {
    doSomething();
} catch (\InvalidArgumentException $e) {
    handleError($e);
}

?>

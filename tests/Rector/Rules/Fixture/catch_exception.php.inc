<?php

namespace DCL\Tests\Rector\Fixture;

use Exception;

try {
    throw new Exception('boom');
} catch (Exception $e) {
    handleError($e);
}

?>
-----
<?php

namespace DCL\Tests\Rector\Fixture;

use Exception;

try {
    throw new Exception('boom');
} catch (\Throwable $e) {
    handleError($e);
}

?>

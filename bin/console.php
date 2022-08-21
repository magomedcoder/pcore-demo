<?php

declare(strict_types=1);

use App\Kernel\{Bootstrap, Console};

define('BASE_PATH', dirname(__DIR__) . '/');

(function () {
    require_once './vendor/autoload.php';
    Bootstrap::boot(true);
    (new Console())->run();
})();
<?php

declare(strict_types=1);

use App\Kernel\{Bootstrap, Kernel};
use PCore\Di\Context;
use PCore\HttpServer\ResponseEmitter\FPMResponseEmitter;
use PCore\HttpServer\ServerRequest;

define('BASE_PATH', dirname(__DIR__) . '/');

(function () {
    require_once __DIR__ . '/../vendor/autoload.php';
    Bootstrap::boot();
    $container = Context::getContainer();
    $kernel = $container->make(Kernel::class);
    (new FPMResponseEmitter())->emit($kernel->through(ServerRequest::createFromGlobals()));
})();
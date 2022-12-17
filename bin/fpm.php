<?php

declare(strict_types=1);

use App\Kernel\{Bootstrap, Kernel};
use PCore\Di\Context;
use PCore\HttpMessage\ServerRequest;
use PCore\HttpServer\ResponseEmitter\FPMResponseEmitter;

define('BASE_PATH', dirname(__DIR__) . '/');

(function () {
    require_once __DIR__ . '/../vendor/autoload.php';
    Bootstrap::boot();
    $kernel = Context::getContainer()->make(Kernel::class);
    $response = $kernel->handle(ServerRequest::createFromGlobals());
    (new FPMResponseEmitter())->emit($response);
})();

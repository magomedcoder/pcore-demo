<?php

declare(strict_types=1);

use App\Kernel\{Bootstrap, Kernel};
use PCore\Di\Context;
use PCore\HttpServer\ResponseEmitter\WorkerManResponseEmitter;
use PCore\HttpServer\ServerRequest;
use Workerman\Connection\TcpConnection;
use Workerman\Protocols\Http\Request;
use Workerman\Worker;

define('BASE_PATH', dirname(__DIR__) . '/');

(function () {
    require_once './vendor/autoload.php';
    if (!class_exists('Workerman\Worker')) {
        throw new Exception('Требуется workerman (composer require workerman/workerman)');
    }
    Bootstrap::boot(true);
    $worker = new Worker('http://0.0.0.0:2346');
    $container = Context::getContainer();
    $kernel = $container->make(Kernel::class);
    $worker->onMessage = function (TcpConnection $connection, Request $request) use ($kernel) {
        (new WorkerManResponseEmitter())->emit($kernel->through(ServerRequest::createFromWorkerManRequest($request, [
            'TcpConnection' => $connection,
            'request' => $request
        ])), $connection);
    };
    $worker->count = 4;
    Worker::runAll();
})();
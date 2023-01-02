<?php

declare(strict_types=1);

use App\Kernel\Bootstrap;
use PCore\Di\Context;
use PCore\Event\EventDispatcher;
use PCore\HttpServer\Contracts\HttpKernelInterface;
use PCore\HttpServer\Events\OnRequest;
use PCore\HttpServer\ResponseEmitter\WorkerManResponseEmitter;
use PCore\HttpMessage\ServerRequest;
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
    $kernel = $container->make(HttpKernelInterface::class);
    $eventDispatcher = $container->make(EventDispatcher::class);
    $worker->onMessage = function (TcpConnection $connection, Request $request) use ($kernel, $eventDispatcher) {
        $psrRequest = ServerRequest::createFromWorkerManRequest($request, [
            'TcpConnection' => $connection,
            'request' => $request
        ]);
        $psrResponse = $kernel->handle($psrRequest);
        (new WorkerManResponseEmitter())->emit($psrResponse, $connection);
        $eventDispatcher->dispatch(new OnRequest($psrRequest, $psrResponse));
    };
    $worker->count = 4;
    Worker::runAll();
})();

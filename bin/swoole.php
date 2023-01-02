<?php

declare(strict_types=1);

use App\Kernel\Bootstrap;
use PCore\Di\Context;
use PCore\Event\EventDispatcher;
use PCore\HttpMessage\ServerRequest;
use PCore\HttpServer\Contracts\HttpKernelInterface;
use PCore\HttpServer\Events\OnRequest;
use PCore\HttpServer\ResponseEmitter\SwooleResponseEmitter;
use Swoole\Constant;
use Swoole\Http\{Request, Response, Server};

define('BASE_PATH', dirname(__DIR__) . '/');

(function () {
    require_once './vendor/autoload.php';
    if (!class_exists('Swoole\Server')) {
        throw new Exception('Требуется Swoole');
    }
    Bootstrap::boot(true);
    $server = new Server('0.0.0.0', 9501);
    $container = Context::getContainer();
    $kernel = $container->make(HttpKernelInterface::class);
    $eventDispatcher = $container->make(EventDispatcher::class);
    $server->on('request', function (Request $request, Response $response) use ($kernel, $eventDispatcher) {
        $psrRequest = ServerRequest::createFromSwooleRequest($request, [
            'request' => $request,
            'response' => $response,
        ]);
        $psrResponse = $kernel->handle($psrRequest);
        (new SwooleResponseEmitter())->emit($psrResponse, $response);
        $eventDispatcher->dispatch(new OnRequest($psrRequest, $psrResponse));
    });
    $server->set([
        Constant::OPTION_WORKER_NUM => swoole_cpu_num(),
        Constant::OPTION_MAX_REQUEST => 100000
    ]);
    $server->start();
})();

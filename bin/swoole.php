<?php

declare(strict_types=1);

use App\Kernel\{Bootstrap, Kernel};
use PCore\Di\Context;
use PCore\HttpMessage\ServerRequest;
use PCore\HttpServer\ResponseEmitter\SwooleResponseEmitter;
use Swoole\Http\{Request, Response, Server};

define('BASE_PATH', dirname(__DIR__) . '/');

(function () {
    require_once './vendor/autoload.php';
    if (!class_exists('Swoole\Server')) {
        throw new Exception('Требуется swoole');
    }
    Bootstrap::boot(true);
    $config = config('server.swoole', []);
    $server = new Server($config['host'], $config['port']);
    /** @var Kernel $kernel */
    $kernel = Context::getContainer()->make(Kernel::class);
    $server->on('request', function (Request $request, Response $response) use ($kernel) {
        $psrResponse = $kernel->through(ServerRequest::createFromSwooleRequest($request, [
            'request' => $request,
            'response' => $response,
        ]));
        (new SwooleResponseEmitter())->emit($psrResponse, $response);
    });
    $server->set($config['settings']);
    $server->start();
})();
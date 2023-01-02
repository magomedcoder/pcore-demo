<?php

declare(strict_types=1);

use App\Kernel\Bootstrap;
use PCore\Di\Context;
use PCore\HttpMessage\ServerRequest;
use PCore\HttpServer\Contracts\HttpKernelInterface;
use PCore\HttpServer\ResponseEmitter\SwooleResponseEmitter;
use Swoole\Constant;
use Swoole\Http\{Request, Response};
use function Swoole\Coroutine\run;

define('BASE_PATH', dirname(__DIR__) . '/');

(function () {
    require_once './vendor/autoload.php';
    if (!class_exists('Swoole\Server')) {
        throw new Exception('Требуется Swoole');
    }
    Bootstrap::boot(true);
    run(function () {
        $server = new Swoole\Coroutine\Http\Server('0.0.0.0', 9501);
        $kernel = Context::getContainer()->make(HttpKernelInterface::class);
        $server->handle('/', function (Request $request, Response $response) use ($kernel) {
            $psrResponse = $kernel->handle(ServerRequest::createFromSwooleRequest($request, [
                'request' => $request,
                'response' => $response,
            ]));
            (new SwooleResponseEmitter())->emit($psrResponse, $response);
        });
        $server->set([
            Constant::OPTION_WORKER_NUM => swoole_cpu_num(),
            Constant::OPTION_MAX_REQUEST => 100000
        ]);
        $server->start();
    });
})();

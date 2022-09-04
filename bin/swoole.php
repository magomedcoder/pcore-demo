<?php

declare(strict_types=1);

use App\Kernel\{Bootstrap, Kernel};
use PCore\Di\Context;
use PCore\HttpServer\ServerRequest;
use PCore\HttpServer\ResponseEmitter\SwooleResponseEmitter;
use Swoole\Constant;
use Swoole\Http\{Request, Response, Server};

define('BASE_PATH', dirname(__DIR__) . '/');

(function () {
    require_once './vendor/autoload.php';
    if (!class_exists('Swoole\Server')) {
        throw new Exception('Требуется swoole');
    }
    Bootstrap::boot(true);
    $server = new Server('0.0.0.0', 9501);
    /** @var Kernel $kernel */
    $kernel = Context::getContainer()->make(Kernel::class);
    $server->on('request', function (Request $request, Response $response) use ($kernel) {
        (new SwooleResponseEmitter())->emit($kernel->through(ServerRequest::createFromSwooleRequest($request, [
            'request' => $request,
            'response' => $response
        ])), $response);
    });
    $server->set([
        Constant::OPTION_WORKER_NUM => swoole_cpu_num(),
        Constant::OPTION_MAX_REQUEST => 100000
    ]);
    $server->start();
})();
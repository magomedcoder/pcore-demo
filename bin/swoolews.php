<?php

declare(strict_types=1);

use App\Controllers\WebSocketController;
use App\Kernel\Bootstrap;
use Swoole\WebSocket\Server;

define('BASE_PATH', dirname(__DIR__) . '/');

(function () {
    require_once './vendor/autoload.php';
    if (!class_exists('Swoole\Server')) {
        throw new Exception('Требуется Swoole');
    }
    Bootstrap::boot(true);
    $server = new Server('0.0.0.0', 9502);
    $callbacks = [
        'open' => [WebSocketController::class, 'onOpen'],
        'message' => [WebSocketController::class, 'onMessage'],
        'close' => [WebSocketController::class, 'onClose']
    ];
    foreach ($callbacks as $eventKey => $callbackItem) {
        [$class, $func] = $callbackItem;
        $server->on($eventKey, [$class, $func]);
    }
    $server->set([
        'worker_num' => swoole_cpu_num(),
        'open_websocket_protocol' => true
    ]);
    $server->start();
})();

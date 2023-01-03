<?php

declare(strict_types=1);

namespace App\Controllers;

use Swoole\WebSocket\Server;

class WebSocketController
{

    /**
     * @param Server $server
     * @param $request
     * @return void
     */
    public static function onOpen(Server $server, $request)
    {
        echo "Open: {$request->fd}\n";
    }

    /**
     * @param Server $server
     * @param $frame
     * @return void
     */
    public static function onMessage(Server $server, $frame)
    {
        echo "Message: {$frame->data}\n";
        $server->push($frame->fd, json_encode(['message' => 'Привет']));
    }

    /**
     * @param Server $server
     * @param $fd
     * @return void
     */
    public static function onClose(Server $server, $fd)
    {
        echo "Close: {$fd}\n";
    }

}

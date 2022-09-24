<?php

declare(strict_types=1);

use App\Kernel\Logger;
use PCore\Config\Contracts\ConfigInterface;
use PCore\Config\Repository;
use PCore\Event\{EventDispatcher, ListenerProvider};
use PCore\HttpServer\Contracts\RouteDispatcherInterface;
use PCore\HttpServer\RouteDispatcher;
use Psr\EventDispatcher\{EventDispatcherInterface, ListenerProviderInterface};
use Psr\Log\LoggerInterface;

return [
    EventDispatcherInterface::class => EventDispatcher::class,
    ListenerProviderInterface::class => ListenerProvider::class,
    RouteDispatcherInterface::class => RouteDispatcher::class,
    ConfigInterface::class => Repository::class,
    LoggerInterface::class => Logger::class
];
<?php

declare(strict_types=1);

use App\Kernel\Logger;
use PCore\Config\Contracts\ConfigInterface;
use PCore\Config\Repository;
use PCore\Console\CommandCollector;
use PCore\Event\{EventDispatcher, ListenerCollector};
use PCore\HttpServer\{RouteCollector, RouteDispatcher};
use PCore\HttpServer\Contracts\RouteDispatcherInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Log\LoggerInterface;

return [
    'aop' => [
        'cache' => false,
        'paths' => ['./src'],
        'runtimeDir' => './var/runtime',
        'collectors' => [RouteCollector::class, ListenerCollector::class, CommandCollector::class]
    ],
    'bindings' => [
        EventDispatcherInterface::class => EventDispatcher::class,
        RouteDispatcherInterface::class => RouteDispatcher::class,
        ConfigInterface::class => Repository::class,
        LoggerInterface::class => Logger::class
    ]
];
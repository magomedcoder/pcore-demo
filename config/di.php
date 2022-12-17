<?php

declare(strict_types=1);

use App\Kernel\Logger;
use PCore\Aop\Collectors\{AspectCollector, PropertyAttributeCollector};
use PCore\Config\Contracts\ConfigInterface;
use PCore\Config\Repository;
use PCore\Console\CommandCollector;
use PCore\Event\{EventDispatcher, ListenerProvider};
use PCore\Event\ListenerCollector;
use PCore\HttpServer\Contracts\RouteDispatcherInterface;
use PCore\HttpServer\RouteDispatcher;
use PCore\Routing\RouteCollector;
use Psr\EventDispatcher\{EventDispatcherInterface, ListenerProviderInterface};
use Psr\Log\LoggerInterface;

return [
    'aop' => [
        'cache' => false,
        'scanDirs' => ['./src'],
        'runtimeDir' => './var/app',
        'collectors' => [
            AspectCollector::class,
            PropertyAttributeCollector::class,
            RouteCollector::class,
            ListenerCollector::class,
            CommandCollector::class
        ]
    ],
    'bindings' => [
        EventDispatcherInterface::class => EventDispatcher::class,
        ListenerProviderInterface::class => ListenerProvider::class,
        RouteDispatcherInterface::class => RouteDispatcher::class,
        ConfigInterface::class => Repository::class,
        LoggerInterface::class => Logger::class
    ]
];

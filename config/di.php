<?php

declare(strict_types=1);

use App\Kernel\{Kernel, Logger};
use PCore\Aop\Collectors\{AspectCollector, PropertyAttributeCollector};
use PCore\Console\CommandCollector;
use PCore\Event\{ListenerCollector};
use PCore\HttpServer\Contracts\HttpKernelInterface;
use PCore\Routing\RouteCollector;
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
        HttpKernelInterface::class => Kernel::class,
        LoggerInterface::class => Logger::class
    ]
];

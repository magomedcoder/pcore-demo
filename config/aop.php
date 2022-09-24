<?php

declare(strict_types=1);

use PCore\Aop\Collectors\{AspectCollector, PropertyAnnotationCollector};
use PCore\Console\CommandCollector;
use PCore\Event\ListenerCollector;
use PCore\HttpServer\RouteCollector;

return [
    'cache' => false,
    'scanDirs' => ['./src'],
    'runtimeDir' => './var/runtime',
    'collectors' => [
        AspectCollector::class,
        PropertyAnnotationCollector::class,
        RouteCollector::class,
        ListenerCollector::class,
        CommandCollector::class
    ]
];
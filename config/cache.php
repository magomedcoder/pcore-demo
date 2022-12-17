<?php

declare(strict_types=1);

use PCore\Cache\Drivers\{ApcuDriver, FileDriver, MemcachedDriver, RedisDriver};
use PCore\Redis\Connectors\BaseConnector;

return [
    'default' => 'file',
    'stores' => [
        'file' => [
            'driver' => FileDriver::class,
            'config' => [
                'path' => __DIR__ . '/../var/cache'
            ]
        ],
        'redis' => [
            'driver' => RedisDriver::class,
            'config' => [
                'connector' => BaseConnector::class,
                'config' => []
            ]
        ],
        'memcached' => [
            'driver' => MemcachedDriver::class,
            'config' => [
                'host' => '127.0.0.1',
                'port' => 11211
            ]
        ],
        'apcu' => [
            'driver' => ApcuDriver::class,
            'config' => []
        ]
    ]
];

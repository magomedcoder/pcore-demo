<?php

declare(strict_types=1);

return [
    'default' => 'file',
    'stores' => [
        'file' => [
            'driver' => 'PCore\Cache\Drivers\FileDriver',
            'config' => [
                'path' => __DIR__ . '/../var/cache'
            ]
        ],
        'redis' => [
            'driver' => 'PCore\Cache\Drivers\RedisDriver',
            'config' => [
                'connector' => 'PCore\Redis\Connectors\BaseConnector',
                'config' => []
            ]
        ],
        'memcached' => [
            'driver' => 'PCore\Cache\Drivers\MemcachedDriver',
            'config' => [
                'host' => '127.0.0.1',
                'port' => 11211
            ]
        ]
    ]
];
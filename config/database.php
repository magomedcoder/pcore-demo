<?php

declare(strict_types=1);

use PCore\Database\Connectors\AutoConnector;
use PCore\Database\DatabaseConfig;

return [
    'default' => 'mysql',
    'connections' => [
        'mysql' => [
            'connector' => AutoConnector::class,
            'options' => [
                DatabaseConfig::OPTION_DRIVER => 'mysql',
                DatabaseConfig::OPTION_HOST => env('DB_HOST', 'localhost'),
                DatabaseConfig::OPTION_PORT => 3306,
                DatabaseConfig::OPTION_POOL_SIZE => 64,
                DatabaseConfig::OPTION_UNIX_SOCKET => null,
                DatabaseConfig::OPTION_USER => env('DB_USER', 'root'),
                DatabaseConfig::OPTION_PASSWORD => env('DB_PASS', 'root'),
                DatabaseConfig::OPTION_DB_NAME => env('DB_NAME', 'pcore_demo'),
                DatabaseConfig::OPTION_OPTIONS => [],
                DatabaseConfig::OPTION_CHARSET => 'utf8'
            ]
        ]
    ]
];
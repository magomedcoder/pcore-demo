<?php

declare(strict_types=1);

use PCore\Database\Connectors\BaseConnector;
use PCore\Database\DatabaseConfig;
use function PCore\Init\env;

return [
    'default' => 'mysql',
    'connections' => [
        'mysql' => [
            'connector' => BaseConnector::class,
            'options' => [
                DatabaseConfig::OPTION_DRIVER => 'mysql',
                DatabaseConfig::OPTION_HOST => env('DB_HOST', 'localhost'),
                DatabaseConfig::OPTION_PORT => 3306,
                DatabaseConfig::OPTION_POOL_SIZE => 12,
                DatabaseConfig::OPTION_UNIX_SOCKET => null,
                DatabaseConfig::OPTION_USER => env('DB_USER', 'user'),
                DatabaseConfig::OPTION_PASSWORD => env('DB_PASS', 'password'),
                DatabaseConfig::OPTION_DB_NAME => env('DB_NAME', 'db'),
                DatabaseConfig::OPTION_OPTIONS => [],
                DatabaseConfig::OPTION_CHARSET => 'utf8mb4'
            ]
        ]
    ]
];
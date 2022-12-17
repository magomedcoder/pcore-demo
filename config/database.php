<?php

declare(strict_types=1);

return [
    'default' => 'base',
    'connections' => [
        'base' => new PCore\Database\Connectors\BaseConnector(
            'mysql',
            env('DB_HOST', 'localhost'),
            3306,
            env('DB_NAME', 'db'),
            env('DB_USER', 'user'),
            env('DB_PASS', 'password')
        ),
//        'basePool' => new PCore\Database\Connectors\BasePoolConnector(
//            'mysql',
//            env('DB_HOST', 'localhost'),
//            3306,
//            env('DB_NAME', 'db'),
//            env('DB_USER', 'user'),
//            env('DB_PASS', 'password')
//        ),
//        'swoolePool' => new PCore\Database\Connectors\SwoolePoolConnector(
//            'mysql',
//            env('DB_HOST', 'localhost'),
//            3306,
//            env('DB_NAME', 'db'),
//            env('DB_USER', 'user'),
//            env('DB_PASS', 'password')
//        )
    ]
];

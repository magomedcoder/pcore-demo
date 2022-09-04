<?php

declare(strict_types=1);

use PCore\Session\Handlers\FileHandler;

return [
    'handler' => FileHandler::class,
    'config' => [
        'path' => __DIR__ . '/../var/session',
        'gcDivisor' => 100,
        'gcProbability' => 1,
        'gcMaxLifetime' => 1440
    ]
];
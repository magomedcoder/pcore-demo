<?php

declare(strict_types=1);

return [
    'handler' => 'PCore\Session\Handlers\FileHandler',
    'config' => [
        'path' => __DIR__ . '/../var/session',
        'gcDivisor' => 100,
        'gcProbability' => 1,
        'gcMaxLifetime' => 1440
    ]
];
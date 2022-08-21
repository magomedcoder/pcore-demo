<?php

declare(strict_types=1);

use Swoole\Constant;

return [
    'swoole' => [
        'port' => 9501,
        'host' => '0.0.0.0',
        'settings' => [
            Constant::OPTION_WORKER_NUM => swoole_cpu_num(),
            Constant::OPTION_MAX_REQUEST => 100000
        ]
    ]
];
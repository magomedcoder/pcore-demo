<?php

declare(strict_types=1);

namespace App\Kernel;

use PCore\HttpServer\Kernel as HttpKernel;

/**
 * Class Kernel
 * @package App\Kernel
 */
class Kernel extends HttpKernel
{

    protected array $middlewares = [
        'App\Middlewares\ExceptionHandleMiddleware',
        'App\Middlewares\CorsMiddleware',
        'App\Middlewares\ParseBodyMiddleware',
        'PCore\HttpServer\Middlewares\RoutingMiddleware'
    ];

}
<?php

declare(strict_types=1);

namespace App\Kernel;

use App\Middlewares\{CorsMiddleware, ExceptionHandleMiddleware};
use PCore\HttpServer\Kernel as HttpKernel;
use PCore\HttpServer\Middlewares\{ParseBodyMiddleware, RoutingMiddleware};

class Kernel extends HttpKernel
{

    /**
     * @var array|string[]
     */
    protected array $middlewares = [
        ExceptionHandleMiddleware::class,
        CorsMiddleware::class,
        ParseBodyMiddleware::class,
        RoutingMiddleware::class
    ];

}

<?php

declare(strict_types=1);

namespace App\Middlewares;

use PCore\HttpServer\Middlewares\CorsMiddleware as BaseCorsMiddleware;

class CorsMiddleware extends BaseCorsMiddleware
{

    /**
     * @var array|string[]
     */
    protected array $allowOrigin = ['*'];

}

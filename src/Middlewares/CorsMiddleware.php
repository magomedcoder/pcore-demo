<?php

declare(strict_types=1);

namespace App\Middlewares;

use PCore\HttpServer\Middlewares\CorsMiddleware as BaseCorsMiddleware;

/**
 * Class CorsMiddleware
 * @package App\Middlewares
 */
class CorsMiddleware extends BaseCorsMiddleware
{

    protected array $allowOrigin = ['*'];

}
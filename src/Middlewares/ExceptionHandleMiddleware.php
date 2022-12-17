<?php

declare(strict_types=1);

namespace App\Middlewares;

use App\Exceptions\HttpExceptionHandler;
use PCore\HttpServer\Middlewares\ExceptionHandleMiddleware as HttpExceptionHandleMiddleware;

class ExceptionHandleMiddleware extends HttpExceptionHandleMiddleware
{

    /**
     * @var array|string[]
     */
    protected array $exceptionHandlers = [HttpExceptionHandler::class];

}

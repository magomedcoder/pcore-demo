<?php

declare(strict_types=1);

namespace App\Middlewares;

use App\Exceptions\Handlers\{HttpExceptionHandler, ValidateExceptionHandler};
use PCore\HttpServer\Middlewares\ExceptionHandleMiddleware as HttpExceptionHandleMiddleware;

class ExceptionHandleMiddleware extends HttpExceptionHandleMiddleware
{

    /**
     * @var array|string[]
     */
    protected array $exceptionHandlers = [HttpExceptionHandler::class, ValidateExceptionHandler::class];

}

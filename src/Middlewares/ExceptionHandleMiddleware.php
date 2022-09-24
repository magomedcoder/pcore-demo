<?php

declare(strict_types=1);

namespace App\Middlewares;

use App\Exceptions\HttpExceptionHandler;
use PCore\HttpServer\Middlewares\ExceptionHandleMiddleware as HttpExceptionHandleMiddleware;

/**
 * Class ExceptionHandleMiddleware
 * @package App\Middlewares
 */
class ExceptionHandleMiddleware extends HttpExceptionHandleMiddleware
{

    protected array $exceptionHandlers = [HttpExceptionHandler::class];

}
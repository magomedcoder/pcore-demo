<?php

declare(strict_types=1);

namespace App\Exceptions\Handlers;

use App\Exceptions\ValidateException;
use PCore\HttpMessage\Response;
use PCore\HttpServer\Contracts\{ExceptionHandlerInterface, StoppableExceptionHandlerInterface};
use Psr\Http\Message\{ResponseInterface, ServerRequestInterface};
use Throwable;

class ValidateExceptionHandler implements ExceptionHandlerInterface, StoppableExceptionHandlerInterface
{

    /**
     * @param Throwable $throwable
     * @param ServerRequestInterface $request
     * @return ResponseInterface|null
     */
    public function handle(Throwable $throwable, ServerRequestInterface $request): ?ResponseInterface
    {
        return Response::json(false, null, $throwable->getArray(), $throwable->getCode());
    }

    /**
     * @param Throwable $throwable
     * @return bool
     */
    public function isValid(Throwable $throwable): bool
    {
        return $throwable instanceof ValidateException;
    }

}

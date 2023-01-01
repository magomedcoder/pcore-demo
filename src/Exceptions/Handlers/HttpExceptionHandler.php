<?php

declare(strict_types=1);

namespace App\Exceptions\Handlers;

use PCore\HttpMessage\Exceptions\HttpException;
use PCore\HttpMessage\Response;
use PCore\HttpServer\Contracts\{ExceptionHandlerInterface, StoppableExceptionHandlerInterface};
use Psr\Http\Message\{ResponseInterface, ServerRequestInterface};
use Throwable;

class HttpExceptionHandler implements ExceptionHandlerInterface, StoppableExceptionHandlerInterface
{

    /**
     * @param Throwable $throwable
     * @param ServerRequestInterface $request
     * @return ResponseInterface|null
     */
    public function handle(Throwable $throwable, ServerRequestInterface $request): ?ResponseInterface
    {
        return Response::json(false, null, [
            'general' => [
                'code' => $statusCode = $throwable->getCode(),
                'message' => $throwable->getMessage()
            ]
        ], $statusCode);
    }

    /**
     * @param Throwable $throwable
     * @return bool
     */
    public function isValid(Throwable $throwable): bool
    {
        return $throwable instanceof HttpException;
    }

}

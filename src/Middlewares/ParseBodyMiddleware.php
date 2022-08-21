<?php

declare(strict_types=1);

namespace App\Middlewares;

use PCore\HttpMessage\Contracts\{HeaderInterface, RequestMethodInterface};
use Psr\Http\Message\{ResponseInterface, ServerRequestInterface};
use Psr\Http\Server\{MiddlewareInterface, RequestHandlerInterface};

/**
 * Class ParseBodyMiddleware
 * @package App\Middlewares
 */
class ParseBodyMiddleware implements MiddlewareInterface
{

    protected array $shouldParseMethods = [
        RequestMethodInterface::METHOD_POST,
        RequestMethodInterface::METHOD_PUT,
        RequestMethodInterface::METHOD_PATCH
    ];

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if (in_array($request->getMethod(), $this->shouldParseMethods) && $content = $request->getBody()?->getContents()) {
            $contentType = $request->getHeaderLine(HeaderInterface::HEADER_CONTENT_TYPE);
            if (str_contains($contentType, 'application/json')) {
                $request = $request->withParsedBody(json_decode($content, true) ?? []);
            }
        }
        return $handler->handle($request);
    }

}
<?php

declare(strict_types=1);

namespace App\Kernel;

use PCore\HttpMessage\Response as BaseResponse;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Response
 * @package App\Kernel
 */
class Response extends BaseResponse
{

    /**
     * @param array|null $errors
     * @param int $status
     * @return ResponseInterface
     */
    public static function jsonError(?array $errors, int $status = 200): ResponseInterface
    {
        return Response::json(false, null, $errors, $status);
    }

}
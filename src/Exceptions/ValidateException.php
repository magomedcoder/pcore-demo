<?php

declare(strict_types=1);

namespace App\Exceptions;

use RuntimeException;
use Throwable;

class ValidateException extends RuntimeException
{

    /**
     * @var array|null
     */
    private ?array $array;

    /**
     * @param array|null $array
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(array $array = null, string $message = '', int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->array = $array;
    }

    /**
     * @return array|null
     */
    public function getArray(): ?array
    {
        return $this->array;
    }

}

<?php

declare(strict_types=1);

namespace App\Abstracts;

use PCore\Validator\Validator;

/**
 * Class AbstractController
 * @package App\Abstracts
 */
class AbstractController
{

    /**
     * @param mixed ...$arg
     * @return Validator
     */
    protected function validate(...$arg): Validator
    {
        $validator = new Validator();
        $validator->make(...$arg);
        return $validator;
    }

}
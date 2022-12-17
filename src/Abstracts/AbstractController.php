<?php

declare(strict_types=1);

namespace App\Abstracts;

use PCore\Validator\Exceptions\ValidatorException;
use PCore\Validator\Validator;

/**
 * Class AbstractController
 * @package App\Abstracts
 */
abstract class AbstractController
{

    /**
     * @param mixed ...$arg
     * @return Validator
     */
    protected function validate(...$arg): Validator
    {
        $validator = new Validator(...$arg);
        $validator->stopOnFirstFailure(false);
        try {
            $validator->validate();
        } catch (ValidatorException $e) {

        }
        return $validator;
    }

}

<?php

declare(strict_types=1);

namespace App\Abstracts;

use App\Exceptions\ValidateException;
use PCore\Validator\Exceptions\ValidatorException;
use PCore\Validator\Validator;
use Psr\Log\LoggerInterface;

abstract class AbstractController
{

    public function __construct(protected LoggerInterface $logger)
    {
    }

    /**
     * @param ...$arg
     * @return Validator
     */
    protected function validate(...$arg): Validator
    {
        $validator = new Validator(...$arg);
        $validator->stopOnFirstFailure(false);
        try {
            $validator->validate();
        } catch (ValidatorException $e) {
            $this->logger->get('validator')
                ->debug($e, []);
        }
        if ($validator->fails()) {
            throw new ValidateException(['fields' => $validator->failed()]);
        }
        return $validator;
    }

}

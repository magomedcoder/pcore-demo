<?php

declare(strict_types=1);

namespace App\Abstracts;

/**
 * Class AbstractService
 * @package App\Abstracts
 */
class AbstractService
{

    /**
     * @var bool
     */
    public bool $fails = false;

    /**
     * @var null|array
     */
    public null|array $failed = null;

    /**
     * @var mixed
     */
    public mixed $data;

    /**
     * @param array $failed
     */
    public function setFails(array $failed)
    {
        $this->fails = true;
        $this->failed = $failed;
    }

    /**
     * @return bool
     */
    public function fails(): bool
    {
        return $this->fails;
    }

    /**
     * @return array
     */
    public function failed(): array
    {
        return $this->failed;
    }

    /**
     * @param array|int|string|bool $data
     */
    public function setData(mixed $data)
    {
        $this->fails = false;
        $this->failed = null;
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function data(): mixed
    {
        return $this->data;
    }

}
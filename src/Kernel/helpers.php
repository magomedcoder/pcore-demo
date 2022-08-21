<?php

declare(strict_types=1);

use PCore\Config\Repository;
use PCore\Di\Context;

if (function_exists('base_path') === false) {
    /**
     * @param string $path
     * @return string
     */
    function base_path(string $path = ''): string
    {
        return BASE_PATH . ltrim($path, '/');
    }
}

if (function_exists('config') === false) {
    /**
     * @param string $key
     * @param null|mixed $default
     * @return mixed
     * @throws ReflectionException
     */
    function config(string $key, $default = null): mixed
    {
        /** @var Repository $config */
        $config = Context::getContainer()->make(Repository::class);
        return $config->get($key, $default);
    }
}
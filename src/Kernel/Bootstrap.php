<?php

declare(strict_types=1);

namespace App\Kernel;

use PCore\Aop\{Scanner, ScannerConfig};
use PCore\Config\Repository;
use PCore\Di\Context;
use PCore\Event\{ListenerCollector, ListenerProvider};
use ReflectionException;

/**
 * Class Bootstrap
 * @package App\Kernel
 */
class Bootstrap
{

    /**
     * @param bool $enable
     * @throws ReflectionException
     */
    public static function boot(bool $enable = false): void
    {
        $container = Context::getContainer();
        $repository = $container->make(Repository::class);
        $repository->scan(base_path('./config'));
        $logger = $container->make(Logger::class);
        if ('cli' === PHP_SAPI) {
            $logger->debug('Сервер запущен.');
        }
        if ($enable) {
            Scanner::init(new ScannerConfig($repository->get('di.aop')));
        }
        foreach ($repository->get('di.bindings') as $id => $value) {
            $container->bind($id, $value);
        }
        $listenerProvider = $container->make(ListenerProvider::class);
        $listeners = $repository->get('listeners');
        foreach (array_unique(array_merge(ListenerCollector::getListeners(), $listeners)) as $listener) {
            $listenerProvider->addListener($container->make($listener));
        }
    }

}
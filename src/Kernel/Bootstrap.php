<?php

declare(strict_types=1);

namespace App\Kernel;

use PCore\Aop\{Scanner, ScannerConfig};
use PCore\Config\Repository;
use PCore\Di\Context;
use PCore\Event\ListenerProvider;
use ReflectionException;
use function putenv;

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
        if (file_exists($envFile = base_path('.env'))) {
            $variables = parse_ini_file($envFile, false, INI_SCANNER_RAW);
            foreach ($variables as $key => $value) {
                putenv(sprintf('%s=%s', $key, $value));
            }
        }
        $repository = $container->make(Repository::class);
        $repository->scan(base_path('./config'));
        if (env('LOGGING_START')) {
            $logger = $container->make(Logger::class);
            if ('cli' === PHP_SAPI) {
                $logger->debug('Сервер запущен.');
            }
        }
        if ($enable) {
            Scanner::init(new ScannerConfig($repository->get('di.aop')));
        }
        foreach ($repository->get('di.bindings') as $id => $value) {
            $container->bind($id, $value);
        }
        $listenerProvider = $container->make(ListenerProvider::class);
        if (!empty($listeners = $repository->get('listeners', []))) {
            foreach ($listeners as $listener) {
                $listenerProvider->addListener($container->make($listener));
            }
        }
    }

}
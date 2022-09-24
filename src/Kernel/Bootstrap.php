<?php

declare(strict_types=1);

namespace App\Kernel;

use Exception;
use PCore\Aop\{Scanner, ScannerConfig};
use PCore\Config\Repository;
use PCore\Database\{DatabaseConfig, Manager};
use PCore\Di\Context;
use PCore\Event\{EventDispatcher, ListenerProvider};
use Psr\Container\ContainerExceptionInterface;
use ReflectionException;
use function PCore\Init\basePath;
use function PCore\Init\env;
use function putenv;

/**
 * Class Bootstrap
 * @package App\Kernel
 */
class Bootstrap
{

    /**
     * @param bool $aop
     * @throws ReflectionException|ContainerExceptionInterface
     * @throws Exception
     */
    public static function boot(bool $aop = false): void
    {
        $container = Context::getContainer();
        if (file_exists($envFile = basePath('.env'))) {
            $variables = parse_ini_file($envFile, false, INI_SCANNER_RAW);
            foreach ($variables as $key => $value) {
                putenv(sprintf('%s=%s', $key, $value));
            }
        }
        $repository = $container->make(Repository::class);
        $repository->scan(basePath('./config'));
        if (env('LOGGING_START')) {
            $logger = $container->make(Logger::class);
            if ('cli' === PHP_SAPI) {
                $logger->debug('Сервер запущен.');
            }
        }
        if ($aop) {
            Scanner::init(new ScannerConfig($repository->get('aop')));
        }
        foreach ($repository->get('di') as $id => $value) {
            $container->bind($id, $value);
        }
        $listenerProvider = $container->make(ListenerProvider::class);
        if (!empty($listeners = $repository->get('listeners', []))) {
            foreach ($listeners as $listener) {
                $listenerProvider->addListener($container->make($listener));
            }
        }
        $database = $repository->get('database');
        $manager = $container->make(Manager::class);
        $manager->setDefault($database['default']);
        foreach ($database['connections'] as $name => $config) {
            $connector = $config['connector'];
            $options = $config['options'];
            $manager->addConnector($name, new $connector(new DatabaseConfig($options)));
        }
        $manager->setEventDispatcher($container->make(EventDispatcher::class));
        $manager->bootEloquent();
    }

}
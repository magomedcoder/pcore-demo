<?php

declare(strict_types=1);

namespace App\Kernel;

use Exception;
use PCore\Aop\{Scanner, ScannerConfig};
use PCore\Config\Repository;
use PCore\Database\Manager;
use PCore\Di\Context;
use PCore\Event\{EventDispatcher, ListenerProvider};
use Psr\Container\ContainerExceptionInterface;
use ReflectionException;
use function putenv;

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
        /**
         * @var Repository
         */
        $repository = $container->make(Repository::class);
        $repository->scan(basePath('./config'));
        if ($aop) {
            Scanner::init(new ScannerConfig($repository->get('di.aop')));
            file_put_contents(basePath('var/app/master.pid'), getmypid());
        }
        $config = [];
        if (file_exists($configFile = basePath('var/app/config.php'))) {
            $config = require $configFile;
        }
        $repository->set('config', $config);
        $bindings = array_merge(
            config('config.bindings', []),
            $repository->get('di.bindings', [])
        );
        foreach ($bindings as $id => $value) {
            $container->bind($id, $value);
        }
        /**
         * @var ListenerProvider
         */
        $listenerProvider = $container->make(ListenerProvider::class);
        if (!empty($listeners = $repository->get('listeners', []))) {
            foreach ($listeners as $listener) {
                $listenerProvider->addListener($container->make($listener));
            }
        }
        $database = $repository->get('database');
        /**
         * @var Manager
         */
        $manager = $container->make(Manager::class);
        $manager->setDefault($database['default']);
        foreach ($database['connections'] as $name => $config) {
            $manager->addConnector($name, $config);
        }
        $manager->setEventDispatcher($container->make(EventDispatcher::class));
        $manager->boot();
    }

}

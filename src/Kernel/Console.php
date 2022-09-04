<?php

declare(strict_types=1);

namespace App\Kernel;

use Exception;
use PCore\Aop\Scanner;
use PCore\Console\CommandCollector;
use Symfony\Component\Console\Application;

/**
 * Class Console
 * @package App\Kernel
 */
class Console
{

    protected array $commands = [];

    /**
     * @throws Exception
     */
    public function run(): void
    {
        $config = Scanner::scanConfig(basePath('vendor/composer/installed.json'));
        $application = new Application();
        foreach (array_merge($this->commands, $config['commands'], CommandCollector::all()) as $command) {
            $application->add(new $command());
        }
        $application->run();
    }

}
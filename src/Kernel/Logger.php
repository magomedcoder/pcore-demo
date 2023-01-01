<?php

namespace App\Kernel;

use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger as MonoLogger;
use PCore\Utils\Logger as BaseLogger;

class Logger extends BaseLogger
{

    public function __construct()
    {
        $this->logger['app'] = new MonoLogger('app', [
            new RotatingFileHandler(
                basePath('var/log/app.log'),
                180,
                MonoLogger::DEBUG
            )
        ]);
        $this->logger['sql'] = new MonoLogger('sql', [
            new RotatingFileHandler(
                basePath('var/log/sql.log'),
                180,
                MonoLogger::DEBUG
            )
        ]);
        $this->logger['validator'] = new MonoLogger('sql', [
            new RotatingFileHandler(
                basePath('var/log/validator.log'),
                180,
                MonoLogger::DEBUG
            )
        ]);
    }

}

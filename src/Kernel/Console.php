<?php

declare(strict_types=1);

namespace App\Kernel;

use PCore\Console\Console as ConsoleKernel;

/**
 * Class Console
 * @package App\Kernel
 */
class Console extends ConsoleKernel
{

    /**
     * @var array
     */
    protected array $commands = [];

}
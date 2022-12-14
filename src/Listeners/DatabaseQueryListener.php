<?php

declare(strict_types=1);

namespace App\Listeners;

use PCore\Database\Events\QueryExecuted;
use PCore\Event\Contracts\EventListenerInterface;
use Psr\Log\LoggerInterface;

class DatabaseQueryListener implements EventListenerInterface
{

    public function __construct(protected LoggerInterface $logger)
    {
    }

    /**
     * @return iterable
     */
    public function listen(): iterable
    {
        return [QueryExecuted::class];
    }

    /**
     * @param object $event
     */
    public function process(object $event): void
    {
        if ($event instanceof QueryExecuted) {
            $this->logger->get('sql')->debug(
                $event->query,
                [
                    'time' => $event->time,
                    'bindings' => $event->bindings
                ]
            );
        }
    }

}

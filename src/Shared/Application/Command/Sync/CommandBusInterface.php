<?php

declare(strict_types=1);

namespace App\Shared\Application\Command\Sync;

interface CommandBusInterface
{
    public function dispatch(CommandInterface $command): void;
}

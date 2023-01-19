<?php

declare(strict_types=1);

namespace Src\Shared\Domain\Bus\Command;

interface CommandBusInterface
{
    public function dispatch(CommandInterface $command): void;
}
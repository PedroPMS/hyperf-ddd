<?php

namespace Src\Shared\Application;

use Src\Shared\Infrastructure\Bus\Messenger\MessengerCommandBus;
use Src\User\Application\Create\CreateUserCommandHandler;
use Src\User\Application\Delete\DeleteUserByIdCommandHandler;
use Src\User\Application\Update\UpdateUserCommandHandler;
use Psr\Container\ContainerInterface;

class CommandBusFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $commandHandlers = [
            make(CreateUserCommandHandler::class),
            make(UpdateUserCommandHandler::class),
            make(DeleteUserByIdCommandHandler::class),
        ];

        return make(MessengerCommandBus::class, compact('commandHandlers'));
    }
}
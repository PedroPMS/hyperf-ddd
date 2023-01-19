<?php

namespace Src\Shared\Domain\Bus\Event;

interface DomainEventSubscriberInterface
{
    public static function subscribedTo(): array;
}
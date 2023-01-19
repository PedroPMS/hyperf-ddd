<?php

namespace Src\Shared\Domain\Bus\Query;

interface QueryBusInterface
{
    public function ask(QueryInterface $query): ?ResponseInterface;
}
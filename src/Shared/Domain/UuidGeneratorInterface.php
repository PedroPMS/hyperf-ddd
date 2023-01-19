<?php

namespace Src\Shared\Domain;

interface UuidGeneratorInterface
{
    public function generate(): string;
}
<?php

namespace App\Infrastructure\Doctrine\Events;

interface AggregateRoot
{
    public function releaseEvents(): array;
}

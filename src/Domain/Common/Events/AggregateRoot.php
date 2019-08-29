<?php

namespace App\Domain\Common\Events;

interface AggregateRoot
{
    public function releaseEvents(): array;
}

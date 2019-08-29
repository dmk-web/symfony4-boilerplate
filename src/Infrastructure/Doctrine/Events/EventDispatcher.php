<?php

namespace App\Infrastructure\Doctrine\Events;

interface EventDispatcher
{
    public function dispatch(array $events): void;
}

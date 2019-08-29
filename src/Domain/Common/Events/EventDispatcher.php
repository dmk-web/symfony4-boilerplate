<?php

namespace App\Domain\Common\Events;

interface EventDispatcher
{
    public function dispatch(array $events): void;
}

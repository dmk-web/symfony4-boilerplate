<?php

namespace App\Infrastructure\Doctrine\Events;

trait EventsTrait
{
    private $recordedEvents = [];

    public function releaseEvents(): array
    {
        $events = $this->recordedEvents;
        $this->recordedEvents = [];
        return $events;
    }

    protected function recordEvent(object $event): void
    {
        $this->recordedEvents[] = $event;
    }
}

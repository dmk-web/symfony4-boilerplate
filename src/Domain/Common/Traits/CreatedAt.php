<?php

namespace App\Domain\Common\Traits;


use DateTimeImmutable;

trait CreatedAt
{
    protected $createdAt;

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    protected function onCreated()
    {
        $this->createdAt = new DateTimeImmutable('now');
    }
}

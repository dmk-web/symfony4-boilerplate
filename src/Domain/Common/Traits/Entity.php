<?php

namespace App\Domain\Common\Traits;


use Ramsey\Uuid\Uuid;

trait Entity
{
    protected $id;

    public function getId(): Uuid
    {
        return $this->id;
    }

    protected function identify()
    {
        $this->id = Uuid::uuid4();
    }
}

<?php

namespace App\Application\Exception;


class ValidationException extends \RuntimeException
{
    private $messages;

    public function __construct(array $messages = [])
    {
        parent::__construct();
        $this->messages = $messages;
    }

    public function getMessages(): array
    {
        return $this->messages;
    }
}

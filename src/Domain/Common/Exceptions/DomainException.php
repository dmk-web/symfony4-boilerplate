<?php

namespace App\Domain\Common\Exceptions;

class DomainException extends \DomainException
{
    public static function format(string $message, ...$args)
    {
        return new static(vsprintf($message, $args));
    }
}

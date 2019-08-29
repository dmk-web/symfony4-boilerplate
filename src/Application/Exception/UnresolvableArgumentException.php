<?php

namespace App\Application\Exception;


use Throwable;

class UnresolvableArgumentException extends HandledException
{
    public static function nullArgument(string $argument): self
    {
        return new self("Argument {$argument} cannot be null.");
    }

    public static function cannotResolveAttribute(string $attribute, string $type, Throwable $previous): self
    {
        return new self("Cannot resolve argument of type '{$type}' with name '{$attribute}'. Reason: '{$previous->getMessage()}'.",
            0, $previous);
    }
}

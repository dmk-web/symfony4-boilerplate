<?php

namespace App\Infrastructure\Exception;


class ArgumentResolvingException extends \RuntimeException
{
    public static function nullArgument(string $argument): self
    {
        return new self("Argument {$argument} cannot be null.");
    }

    public static function notArray(string $argument, string $actual): self
    {
        return new self("Argument {$argument} must be array. Deserialized type: {$actual}.");
    }

    public static function cannotResolveAttribute(string $attribute, string $type, \Throwable $previous): self
    {
        return new self("Cannot resolve argument of type '{$type}' with name '{$attribute}'. Reason: '{$previous->getMessage()}'.",
            0, $previous);
    }

    public static function unsupportedAnnotationType(string $annotation)
    {
        return new self("Annotation {$annotation} is not supported for request param resolving.");
    }
}

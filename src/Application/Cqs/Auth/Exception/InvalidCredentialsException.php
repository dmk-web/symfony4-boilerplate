<?php

namespace App\Application\Cqs\Auth\Exception;


use App\Application\Exception\RuntimeException;

class InvalidCredentialsException extends RuntimeException
{
    public static function userNotFound(string $username)
    {
        return new self("User with username '{$username}' not found.");
    }
}

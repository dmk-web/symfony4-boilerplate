<?php

namespace App\Application\Cqs\Auth\Exception;

use App\Application\Exception\HandledException;

class InvalidCredentialsException extends HandledException
{
    public static function userNotFound(string $username)
    {
        return new self("User with username '{$username}' not found.");
    }
}

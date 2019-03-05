<?php

namespace App\Application\Cqs\User\Exception;


use App\Application\Exception\RuntimeException;

class CreationException extends RuntimeException
{
    public static function loginIsBusy(string $login)
    {
        return new self("Login '{$login}' is busy.");
    }
}
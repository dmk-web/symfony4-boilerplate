<?php

namespace App\Application\Cqs\User\Exception;


use App\Application\Exception\HandledException;

class CreationException extends HandledException
{
    public static function loginIsBusy(string $login)
    {
        return new self("Login '{$login}' is busy.");
    }
}

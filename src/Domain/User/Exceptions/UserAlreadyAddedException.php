<?php

namespace App\Domain\User\Exceptions;


use App\Infrastructure\Doctrine\Exceptions\RepositoryException;

class UserAlreadyAddedException extends RepositoryException
{

}

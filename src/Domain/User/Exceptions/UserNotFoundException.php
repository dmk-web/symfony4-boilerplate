<?php

namespace App\Domain\User\UserExceptions;


use App\Infrastructure\Doctrine\Exceptions\RepositoryException;

class UserNotFoundException extends RepositoryException
{

}

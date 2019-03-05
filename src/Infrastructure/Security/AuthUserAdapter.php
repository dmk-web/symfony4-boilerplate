<?php

namespace App\Infrastructure\Security;


use App\Domain\Entity\User\User;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Security\Core\User\UserInterface;

class AuthUserAdapter implements UserInterface
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getId(): Uuid
    {
        return $this->user->getId();
    }

    public function getRoles()
    {
        return [$this->user->getRole()];
    }

    public function getPassword()
    {
        return $this->user->getPassword();
    }

    public function getUsername()
    {
        return $this->user->getLogin();
    }

    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials()
    {
    }
}

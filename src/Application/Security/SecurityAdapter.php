<?php

namespace App\Application\Security;

use App\Domain\User\Entity\User;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Security\Core\User\UserInterface;

class SecurityAdapter implements UserInterface
{
    /** @var User */
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function unwrap(): User
    {
        return $this->user;
    }

    public function getId(): Uuid
    {
        return $this->user->getId();
    }

    public function getRoles()
    {
        return $this->user->getRoles();
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

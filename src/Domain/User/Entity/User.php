<?php

namespace App\Domain\User\Entity;


use App\Domain\Common\Traits\CreatedAt;
use App\Domain\Common\Traits\Entity;
use App\Domain\Common\Traits\UpdatedAt;
use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface
{
    use Entity, CreatedAt, UpdatedAt;

    public const ADMIN_ROLE = 'ADMIN_ROLE';

    private $username;
    private $login;
    private $password;
    private $roles;
    private $isActivated = true;

    public function __construct(string $username, string $login, string $password, array $roles)
    {
        $this->identify();
        $this->onCreated();

        $this->username = $username;
        $this->login = $login;
        $this->password = $password;
        $this->roles = $roles;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function changePassword(string $password)
    {
        $this->password = $password;
    }

    public function setRoles(array $roles)
    {
        $this->roles = $roles;
    }

    public function isActivated(): bool
    {
        return $this->isActivated;
    }

    public function deactivate()
    {
        $this->isActivated = false;
        $this->onUpdated();
    }

    public function activate()
    {
        $this->isActivated = true;
        $this->onUpdated();
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function getSalt()
    {
        return;
    }

    public function eraseCredentials()
    {
        return;
    }
}

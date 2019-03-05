<?php

namespace App\Domain\Entity\User;


use App\Domain\Common\Traits\CreatedAt;
use App\Domain\Common\Traits\Entity;
use App\Domain\Common\Traits\UpdatedAt;

class User
{
    use Entity, CreatedAt, UpdatedAt;

    public const ADMIN_ROLE = 'ADMIN_ROLE';

    private $name;
    private $login;
    private $password;
    private $role;
    private $isActivated = true;

    public function __construct(string $name, string $login, string $password, string $role)
    {
        $this->identify();
        $this->onCreated();

        $this->name = $name;
        $this->login = $login;
        $this->password = $password;
        $this->role = $role;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function getName(): string
    {
        return $this->name;
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
}

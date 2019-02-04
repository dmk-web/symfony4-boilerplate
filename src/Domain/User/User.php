<?php

namespace App\Domain\User;


use Ramsey\Uuid\UuidInterface;

class User
{
    /** @var UuidInterface */
    private $id;
    /** @var string */
    private $username;
    /** @var string */
    private $email;
    /** @var HashedPassword */
    private $hashedPassword;

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    private function setEmail(string $email): void
    {
        $this->email = $email;
    }

    private function setHashedPassword(HashedPassword $hashedPassword): void
    {
        $this->hashedPassword = $hashedPassword;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }
}

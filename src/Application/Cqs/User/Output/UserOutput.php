<?php

namespace App\Application\Cqs\User\Output;


use App\Domain\User\Entity\User;
use Ramsey\Uuid\Uuid;

class UserOutput
{
    /**
     *
     * @var Uuid
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $login;

    /**
     * @var array
     */
    public $roles;

    /**
     * @var \DateTimeImmutable
     */
    public $createdAt;

    /**
     * @var \DateTimeImmutable|null
     */
    public $updatedAt;

    public static function from(User $user)
    {
        $self = new self();
        $self->id = $user->getId();
        $self->name = $user->getUsername();
        $self->login = $user->getLogin();
        $self->roles = $user->getRoles();
        $self->createdAt = $user->getCreatedAt();
        $self->updatedAt = $user->getUpdatedAt();

        return $self;
    }
}

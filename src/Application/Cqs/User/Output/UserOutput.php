<?php

namespace App\Application\Cqs\User\Output;


use App\Domain\Entity\User\User;
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
     * @var string
     */
    public $role;

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
        $self->name = $user->getName();
        $self->login = $user->getLogin();
        $self->role = $user->getRole();
        $self->createdAt = $user->getCreatedAt();
        $self->updatedAt = $user->getUpdatedAt();

        return $self;
    }
}

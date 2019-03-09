<?php

namespace App\Application\Cqs\User\Input;


use Symfony\Component\Validator\Constraints as Assert;

class CreateUserInput
{
    /**
     * @var string
     *
     * @Assert\NotBlank()
     */
    public $username;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(min = 6)
     */
    public $login;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(min = 6)
     */
    public $password;

    /**
     * @var array
     *
     * @Assert\NotBlank()
     */
    public $roles;
}

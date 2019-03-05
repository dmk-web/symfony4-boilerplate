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
    public $name;

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
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Choice({
     *     User::ADMIN_ROLE
     * })
     */
    public $role;
}

<?php

namespace App\Application\Cqs\Auth\Input;


use Symfony\Component\Validator\Constraints as Assert;

class TokenInput
{
    /**
     *
     * @var string
     *
     * @Assert\NotBlank()
     */
    public $login;

    /**
     *
     * @var string
     *
     * @Assert\NotBlank()
     */
    public $password;
}

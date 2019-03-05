<?php

namespace App\Application\Cqs\Auth\Input;


use Symfony\Component\Validator\Constraints as Assert;

class TokenInput
{
    /**
     *
     * @var string
     *
     * @Assert\NotBlank(message = ObtainTokensInput::BLANK_USERNAME)
     */
    public $username;

    /**
     *
     * @var string
     *
     * @Assert\NotBlank(message = ObtainTokensInput::BLANK_PASSWORD)
     */
    public $password;
}

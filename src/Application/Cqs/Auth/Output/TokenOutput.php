<?php

namespace App\Application\Cqs\Auth\Output;


class TokenOutput
{
    public static function from(string $token)
    {
        $self = new self();
        $self->token = $token;
        return $self;
    }

    /**
     * @var string
     */
    public $token;
}

<?php

namespace App\Application\Cqs\Auth\Output;


use Std\Token\TokenPair;

class TokenPairOutput
{
    public static function from(TokenPair $pair)
    {
        $self = new self();
        $self->accessToken = $pair->getAccessToken();
        $self->accessTokenTtl = $pair->getAccessTokenTtl();
        $self->refreshToken = $pair->getRefreshToken();
        $self->refreshTokenTtl = $pair->getRefreshTokenTtl();

        return $self;
    }

    /**
     * Access токен для авторизации запросов.
     *
     * @var string
     */
    public $accessToken;

    /**
     * Время жизни access токена в виде timestamp метки.
     *
     * @var int
     */
    public $accessTokenTtl;

    /**
     * Refresh токен для продления сессии.
     *
     * @var string
     */
    public $refreshToken;

    /**
     * Время жизни refresh токена в виде timestamp метки.
     *
     * @var int
     */
    public $refreshTokenTtl;
}

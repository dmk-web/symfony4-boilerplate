<?php

namespace App\Application\Security;


use App\Domain\User\Entity\User;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Authentication\Token\JWTUserToken;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class LoggedUserProvider
{
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    public function provideEntity(): ?User
    {
        $adapter = $this->provideAdapter();

        if (null !== $adapter) {
            return $adapter->unwrap();
        }

        return null;
    }

    public function provideAdapter(): ?SecurityAdapter
    {
        $token = $this->tokenStorage->getToken();

        if ($token instanceof JWTUserToken) {
            /** @var SecurityAdapter $adapter */
            $adapter = $token->getUser();
            return $adapter;
        }

        return null;
    }
}

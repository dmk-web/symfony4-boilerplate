<?php

namespace App\Infrastructure\Security;


use App\Domain\User\Repository\UserRepositoryInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class AuthProvider implements UserProviderInterface
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        return $this->loadUserByUsername($user->getUsername());
    }

    public function loadUserByUsername($username)
    {
        $user = $this->userRepository
            ->findByLogin($username);

        return new AuthUserAdapter($user);
    }

    public function supportsClass($class): bool
    {
        return AuthUserAdapter::class === $class;
    }
}

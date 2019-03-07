<?php

namespace App\Infrastructure\Security;


use App\Domain\User\Repository\UserRepositoryInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
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
        return $this->loadUserByUsername($user);
    }

    public function loadUserByUsername($login)
    {
        $user = $this->userRepository->findByLogin($login);
        if (null === $user) {
            throw new UsernameNotFoundException("User with login $login not found.");
        }
        return new AuthUserAdapter($user);
    }

    public function supportsClass($class): bool
    {
        return AuthUserAdapter::class === $class;
    }
}

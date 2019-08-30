<?php

namespace App\Application\Security;


use App\Domain\User\Repository\UserRepositoryInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserProvider implements UserProviderInterface
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function refreshUser(UserInterface $user): SecurityAdapter
    {
        return $this->loadUserByUsername($user->getUsername());
    }

    public function loadUserByUsername($login): SecurityAdapter
    {
        $user = $this->userRepository->findByLogin($login);

        if (null === $user) {
            throw new UsernameNotFoundException("User with login '{$login}' not found.");
        }

        return new SecurityAdapter($user);
    }

    public function supportsClass($class): bool
    {
        return SecurityAdapter::class === $class;
    }
}

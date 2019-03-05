<?php

namespace App\Application\Cqs\Auth\Command;


use App\Application\Cqs\Auth\Exception\InvalidCredentialsException;
use App\Application\Cqs\Auth\Input\TokenInput;
use App\Domain\User\Repository\UserRepositoryInterface;
use App\Infrastructure\Security\AuthUserAdapter;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class GetTokenCommand
{
    private $userRepository;
    private $tokenManager;
    private $passwordEncoder;

    public function __construct(
        JWTTokenManagerInterface $tokenManager,
        UserRepositoryInterface $userRepository,
        UserPasswordEncoderInterface $passwordEncoder
    ) {
        $this->userRepository = $userRepository;
        $this->passwordEncoder = $passwordEncoder;
        $this->tokenManager = $tokenManager;
    }

    public function execute(TokenInput $input): string
    {
        $user = $this->userRepository->findByLogin($input->username);
        if (!$user) {
            throw InvalidCredentialsException::userNotFound($input->username);
        }
        $userAdapter = new AuthUserAdapter($user);
        $isValid = $this->passwordEncoder->isPasswordValid($userAdapter, $input->password);
        if (!$isValid) {
            throw InvalidCredentialsException::userNotFound($input->username);
        }
        return $this->tokenManager->create($userAdapter);
    }
}

<?php

namespace App\Application\Cqs\Auth\Command;


use App\Application\Cqs\Auth\Exception\InvalidCredentialsException;
use App\Application\Cqs\Auth\Input\TokenInput;
use App\Application\Cqs\Auth\Output\TokenOutput;
use App\Application\Security\SecurityAdapter;
use App\Domain\User\Repository\UserRepositoryInterface;
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

    public function execute(TokenInput $input): TokenOutput
    {
        $user = $this->userRepository->findByLogin($input->login);

        if (null === $user) {
            throw InvalidCredentialsException::userNotFound($input->login);
        }

        $adapter = new SecurityAdapter($user);

        if (!$this->passwordEncoder->isPasswordValid($adapter, $input->password)) {
            throw InvalidCredentialsException::userNotFound($input->login);
        }

        return TokenOutput::from($this->tokenManager->create($user));
    }
}

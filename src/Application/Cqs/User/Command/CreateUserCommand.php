<?php

namespace App\Application\Cqs\User\Command;


use App\Application\Cqs\User\Exception\CreationException;
use App\Application\Cqs\User\Input\CreateUserInput;
use App\Domain\Entity\User\User;
use App\Domain\User\Repository\UserRepositoryInterface;

class CreateUserCommand
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(CreateUserInput $input)
    {
        if ($this->userRepository->isExistWithLogin($input->login)) {
            throw new CreationException("Login '{$input->login}' is already busied.");
        }

        $user = new User($input->name, $input->login, $input->password, $input->role);
        $this->userRepository->add($user);
    }
}

<?php

namespace App\Application\Cqs\User\Command;


use App\Application\Cqs\User\Exception\CreationException;
use App\Application\Cqs\User\Input\CreateUserInput;
use App\Application\Cqs\User\Output\UserOutput;
use App\Domain\User\Entity\User;
use App\Domain\User\Repository\UserRepositoryInterface;
use App\Infrastructure\Doctrine\Transactions\TransactionInterface;

class CreateUserCommand
{
    private $userRepository;
    private $transaction;

    public function __construct(UserRepositoryInterface $userRepository, TransactionInterface $transaction)
    {
        $this->userRepository = $userRepository;
        $this->transaction = $transaction;
    }

    public function execute(CreateUserInput $input)
    {
        if ($this->userRepository->isExistWithLogin($input->login)) {
            throw new CreationException("Login '{$input->login}' is already busied.");
        }

        $user = new User($input->username, $input->login, password_hash($input->password, PASSWORD_BCRYPT),
            $input->roles);
        $this->transaction->transactional(function () use ($user) {
            $this->userRepository->add($user);
        });
        return UserOutput::from($user);
    }
}

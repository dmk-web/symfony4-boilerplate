<?php

namespace App\Application\Cli;


use App\Domain\User\Entity\User;
use App\Domain\User\Repository\UserRepositoryInterface;
use App\Infrastructure\Doctrine\Interfaces\TransactionInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class AddUserCommand extends Command
{
    private $userRepository;
    private $transaction;

    public function __construct(UserRepositoryInterface $userRepository, TransactionInterface $transaction)
    {
        parent::__construct('cli:add-user');

        $this->userRepository = $userRepository;
        $this->transaction = $transaction;
    }

    protected function configure()
    {
        $this->addOption('username', 'u', InputOption::VALUE_REQUIRED);
        $this->addOption('login', 'l', InputOption::VALUE_REQUIRED);
        $this->addOption('password', 'p', InputOption::VALUE_REQUIRED);
        $this->addOption('role', 'r', InputOption::VALUE_REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        [$username, $login, $password, $role] = [
            $input->getOption('username'),
            $input->getOption('login'),
            $input->getOption('password'),
            $input->getOption('role')
        ];

        $this->transaction->transactional(function () use ($username, $login, $password, $role) {
            $this->userRepository->add(new User($username, $login, password_hash($password, PASSWORD_BCRYPT), [$role]));
        });

        $output->writeln("User {$username} successfully added!");
    }
}


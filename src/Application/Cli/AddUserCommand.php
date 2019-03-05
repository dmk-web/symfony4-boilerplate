<?php

namespace App\Application\Cli;


use App\Domain\Entity\User\User;
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
        $this->addOption('name', 'd', InputOption::VALUE_REQUIRED);
        $this->addOption('login', 'u', InputOption::VALUE_REQUIRED);
        $this->addOption('password', 'p', InputOption::VALUE_REQUIRED);
        $this->addOption('role', 'r', InputOption::VALUE_REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        [$name, $login, $password, $role] = [
            $input->getOption('name'),
            $input->getOption('login'),
            $input->getOption('password'),
            $input->getOption('role')
        ];

        $this->transaction->transactional(function () use ($name, $login, $password, $role) {
            $this->userRepository->add(new User($name, $login, password_hash($password, PASSWORD_BCRYPT), $role));
        });

        $output->writeln("User {$name} successfully added!");
    }
}


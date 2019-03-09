<?php

namespace App\Application\Cqs\User\Query;


use App\Application\Cqs\User\Output\UserOutput;
use App\Domain\User\Repository\UserRepositoryInterface;

class GetUserQuery
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(string $userId): UserOutput
    {
        return UserOutput::from($this->userRepository->get($userId));
    }
}

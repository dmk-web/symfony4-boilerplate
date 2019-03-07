<?php

namespace App\Application\Cqs\User\Query;


use App\Application\Cqs\User\Output\UserOutput;
use App\Domain\User\Entity\User;
use App\Domain\User\Repository\UserRepositoryInterface;

class GetUsersQuery
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(int $limit, int $offset): array
    {
        $users = $this->userRepository->findAll($limit, $offset);
        $result = array_map(function (User $user) {
            return UserOutput::from($user);
        }, $users);
        return $result;
    }
}

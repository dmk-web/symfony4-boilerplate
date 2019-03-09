<?php


namespace App\Application\Http\User;


use App\Application\Cqs\User\Command\CreateUserCommand;
use App\Application\Cqs\User\Input\CreateUserInput;
use App\Application\Cqs\User\Query\GetUserQuery;
use App\Application\Cqs\User\Query\GetUsersQuery;
use Symfony\Component\Routing\Annotation\Route;

class UserController
{
    /**
     * @Route("/users/{userId}", methods={"GET"})
     */
    public function get(string $userId, GetUserQuery $query)
    {
        return $query->execute($userId);
    }

    /**
     * @Route("/users", methods={"GET"})
     */
    public function getAll(GetUsersQuery $query, int $limit = 10, ?int $offset = 0)
    {
        return $query->execute($limit, $offset);
    }

    /**
     * @Route("/users", methods={"POST"})
     */
    public function create(CreateUserCommand $command, CreateUserInput $input)
    {
        return $command->execute($input);
    }
}

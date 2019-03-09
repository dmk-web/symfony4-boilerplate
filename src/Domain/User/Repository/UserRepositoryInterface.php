<?php

namespace App\Domain\User\Repository;

use App\Domain\User\Entity\User;
use Ramsey\Uuid\Uuid;

interface UserRepositoryInterface
{
    public function add(User $user);

    public function get(string $userId): User;

    public function has(Uuid $usedId): bool;

    public function findByLogin(string $login): ?User;

    public function isExistWithLogin(string $login): bool;

    public function findAll(int $limit, int $offset): array;
}

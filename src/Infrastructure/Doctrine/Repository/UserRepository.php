<?php

namespace App\Infrastructure\Doctrine\Repository;


use App\Domain\Entity\User\User;
use App\Domain\User\Repository\UserRepositoryInterface;
use App\Domain\User\UserExceptions\UserAlreadyAddedException;
use App\Domain\User\UserExceptions\UserNotFoundException;
use Ramsey\Uuid\Uuid;

class UserRepository extends BaseDoctrineRepository implements UserRepositoryInterface
{
    public function add(User $user)
    {
        if ($this->entityManager->contains($user)) {
            throw new UserAlreadyAddedException("User with id {$user->getId()} is already added.");
        }

        $this->entityManager->persist($user);
    }

    public function get(Uuid $userId): User
    {
        $user = $this->entityManager->find(User::class, $userId);

        if (null === $user) {
            throw new UserNotFoundException("User with id {$userId} not found.");
        }

        return $user;
    }

    public function has(Uuid $usedId): bool
    {
        return $this->entityManager->getRepository(User::class)->count(['id' => $usedId]) === 1;
    }

    public function findByLogin(string $login): ?User
    {
        return $this->entityManager->getRepository(User::class)->findOneBy(['login' => $login]);
    }

    public function isExistWithLogin(string $login): bool
    {
        return $this->entityManager->getRepository(User::class)->count(['login' => $login]) === 1;
    }

    public function findAll(int $limit, int $offset): array
    {
        return $this->entityManager->createQueryBuilder()
            ->from(User::class, 'user')
            ->select('user')
            ->setMaxResults($limit)
            ->setFirstResult($offset)
            ->getQuery()
            ->getResult();
    }
}

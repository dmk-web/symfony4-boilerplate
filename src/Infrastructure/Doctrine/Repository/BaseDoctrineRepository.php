<?php

namespace App\Infrastructure\Doctrine\Repository;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\QueryBuilder;
use Ramsey\Uuid\Uuid;

abstract class BaseDoctrineRepository
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    public function setEntityManager(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    protected function find(string $entityClass, Uuid $id)
    {
        return $this->entityManager->find($entityClass, $id);
    }

    protected function select(string $entityClass, string $alias): QueryBuilder
    {
        return $this->entityManager->createQueryBuilder()->from($entityClass, $alias)->select($alias);
    }

    protected function from(string $entity, string $alias, string $indexBy = null)
    {
        return $this->entityManager->createQueryBuilder()->from($entity, $alias, $indexBy);
    }
}

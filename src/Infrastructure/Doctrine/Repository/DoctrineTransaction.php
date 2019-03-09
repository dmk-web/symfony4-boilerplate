<?php

namespace App\Infrastructure\Doctrine\Repository;


use App\Infrastructure\Doctrine\Interfaces\TransactionInterface;
use Doctrine\ORM\EntityManager;

class DoctrineTransaction implements TransactionInterface
{
    private $manager;
    private $connection;

    public function __construct(EntityManager $manager)
    {
        $this->manager = $manager;
        $this->connection = $manager->getConnection();
    }

    /** @inheritdoc */
    public function transactional(callable $scope)
    {
        $this->connection->beginTransaction();

        try {
            $returned = $scope();

            $this->manager->flush();
            $this->connection->commit();

            return $returned;
        } catch (\Throwable $e) {
            $this->manager->close();
            $this->connection->rollBack();

            throw $e;
        }
    }
}

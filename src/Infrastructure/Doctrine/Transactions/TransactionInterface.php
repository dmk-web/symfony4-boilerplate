<?php

namespace App\Infrastructure\Doctrine\Transactions;

interface TransactionInterface
{
    public function transactional(callable $scope);
}

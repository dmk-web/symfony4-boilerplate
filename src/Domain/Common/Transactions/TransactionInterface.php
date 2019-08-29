<?php

namespace App\Domain\Common\Transactions;

interface TransactionInterface
{
    public function transactional(callable $scope);
}

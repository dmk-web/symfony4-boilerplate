<?php

namespace App\Infrastructure\Doctrine\Interfaces;


interface TransactionInterface
{
    public function transactional(callable $scope);
}

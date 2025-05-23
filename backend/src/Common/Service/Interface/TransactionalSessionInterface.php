<?php

namespace App\Common\Service\Interface;

interface TransactionalSessionInterface
{
    public function executeTransaction(callable $operation): mixed;
}
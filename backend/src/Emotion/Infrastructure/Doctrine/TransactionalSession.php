<?php

namespace App\Emotion\Infrastructure\Doctrine;

use App\Common\Service\Interface\TransactionalSessionInterface;
use Doctrine\ORM\EntityManagerInterface;

final class TransactionalSession implements TransactionalSessionInterface
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function executeTransaction(callable $operation): mixed
    {
        return $this->entityManager->wrapInTransaction($operation);
    }
}
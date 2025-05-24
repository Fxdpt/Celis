<?php

namespace App\Emotion\Application\Repository;

use App\Emotion\Domain\Model\TriggerEvent;

interface ReadTriggerEventRepositoryInterface
{
    public function findByName(string $name): ?TriggerEvent;
}
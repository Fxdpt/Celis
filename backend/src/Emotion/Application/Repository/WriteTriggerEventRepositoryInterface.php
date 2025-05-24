<?php

namespace App\Emotion\Application\Repository;

use App\Emotion\Domain\Model\TriggerEvent;

interface WriteTriggerEventRepositoryInterface
{
    public function add(TriggerEvent $triggerEvent): int;
}
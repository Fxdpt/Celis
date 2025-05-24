<?php

namespace App\Emotion\Infrastructure\Doctrine\Entity;

use App\Emotion\Domain\Model\TriggerEvent as ModelTriggerEvent;
use App\Emotion\Infrastructure\Repository\TriggerEventRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TriggerEventRepository::class)]
class TriggerEvent
{
    public function __construct(
        #[ORM\Id]
        #[ORM\GeneratedValue]
        #[ORM\Column]
        private ?int $id = null, #[ORM\Column(length: 255)]
        private ?string $name = null,
    ) {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function toModel(): ModelTriggerEvent
    {
        return new ModelTriggerEvent(
            id: $this->id,
            name: $this->name,
        );
    }

    public static function fromModel(ModelTriggerEvent $model): TriggerEvent
    {
        return new TriggerEvent(
            id: $model->getId(),
            name: $model->getName(),
        );
    }
}

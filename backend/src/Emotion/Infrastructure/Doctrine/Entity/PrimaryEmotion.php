<?php

namespace App\Emotion\Infrastructure\Doctrine\Entity;

use App\Emotion\Domain\Model\PrimaryEmotion\PrimaryEmotion as ModelPrimaryEmotion;
use App\Emotion\Domain\Model\PrimaryEmotion\PrimaryEmotionLabelEnum;
use App\Emotion\Infrastructure\Repository\PrimaryEmotionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PrimaryEmotionRepository::class)]
class PrimaryEmotion
{

    public function __construct(
        #[ORM\Id]
        #[ORM\GeneratedValue]
        #[ORM\Column]
        private ?int $id = null,
        #[ORM\Column(length: 255)]
        private ?string $emotionLabel = null,
    ) {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmotionLabel(): ?string
    {
        return $this->emotionLabel;
    }

    public function setEmotionLabel(string $emotionLabel): static
    {
        $this->emotionLabel = $emotionLabel;

        return $this;
    }

    public function toModel(): ModelPrimaryEmotion
    {

        return new ModelPrimaryEmotion(
            id: $this->id,
            emotionLabel: PrimaryEmotionLabelEnum::tryFrom(strtolower($this->emotionLabel)),
        );
    }

    public static function fromModel(ModelPrimaryEmotion $model): PrimaryEmotion
    {
        return new PrimaryEmotion(
            id: $model->getId(),
            emotionLabel: $model->getEmotionLabel()->value,
        );
    }
}

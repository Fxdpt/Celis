<?php

namespace App\Emotion\Infrastructure\Doctrine\Entity;

use App\Emotion\Infrastructure\Repository\TertiaryEmotionRepository;
use App\Emotion\Domain\Model\TertiaryEmotion\TertiaryEmotion as ModelTertiaryEmotion;
use App\Emotion\Domain\Model\EmotionLog as ModelEmotionLog;
use App\Emotion\Domain\Model\TertiaryEmotion\TertiaryEmotionLabelEnum;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\MaxDepth;

#[ORM\Entity(repositoryClass: TertiaryEmotionRepository::class)]
class TertiaryEmotion
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

    public function toModel(): ModelTertiaryEmotion
    {
        return new ModelTertiaryEmotion(
            id: $this->id,
            emotionLabel: TertiaryEmotionLabelEnum::tryFrom(strtolower($this->emotionLabel)),
        );
    }

    public static function fromModel(ModelTertiaryEmotion $model): TertiaryEmotion
    {
        return new TertiaryEmotion(
            id: $model->getId(),
            emotionLabel: $model->getEmotionLabel()->value,
        );
    }
}

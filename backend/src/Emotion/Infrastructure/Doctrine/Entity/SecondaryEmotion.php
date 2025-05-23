<?php

namespace App\Emotion\Infrastructure\Doctrine\Entity;

use App\Emotion\Domain\Model\EmotionLog as ModelEmotionLog;
use App\Emotion\Domain\Model\SecondaryEmotion\SecondaryEmotion as ModelSecondaryEmotion;
use App\Emotion\Domain\Model\SecondaryEmotion\SecondaryEmotionLabelEnum;
use App\Emotion\Infrastructure\Repository\SecondaryEmotionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\MaxDepth;

#[ORM\Entity(repositoryClass: SecondaryEmotionRepository::class)]
class SecondaryEmotion
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

    public function toModel(): ModelSecondaryEmotion
    {

        return new ModelSecondaryEmotion(
            id: $this->id,
            emotionLabel: SecondaryEmotionLabelEnum::tryFrom(strtolower($this->emotionLabel))
        );
    }

    public static function fromModel(ModelSecondaryEmotion $model): SecondaryEmotion
    {
        return new SecondaryEmotion(
            id: $model->getId(),
            emotionLabel: $model->getEmotionLabel()->value,
        );
    }
}

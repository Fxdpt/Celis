<?php

namespace App\Emotion\Infrastructure\Doctrine\Entity;

use App\Emotion\Domain\Model\EmotionLog as ModelEmotionLog;
use App\Emotion\Infrastructure\Repository\EmotionLogRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use \App\Emotion\Infrastructure\Doctrine\Entity\TriggerEvent;

#[ORM\Entity(repositoryClass: EmotionLogRepository::class)]
class EmotionLog
{

    #[ORM\ManyToOne(inversedBy: 'emotionLogs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TriggerEvent $triggerEvent = null;

    public function __construct(
        #[ORM\Id]
        #[ORM\GeneratedValue]
        #[ORM\Column]
        private ?int $id = null,
        #[ORM\Column]
        private int $date,
        #[ORM\ManyToOne(inversedBy: 'emotionLog')]
        #[ORM\JoinColumn(nullable: false)]
        private PrimaryEmotion $primaryEmotion,
        #[ORM\ManyToOne(inversedBy: 'emotionLog')]
        #[ORM\JoinColumn(nullable: false)]
        private SecondaryEmotion $secondaryEmotion,
        #[ORM\ManyToOne(inversedBy: 'emotionLog')]
        #[ORM\JoinColumn(nullable: false)]
        private TertiaryEmotion $tertiaryEmotion,
        #[ORM\Column(type: Types::TEXT, nullable: true)]
        private ?string $comment = null
    ) {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): int
    {
        return $this->date;
    }

    public function setDate(int $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): static
    {
        $this->comment = $comment;

        return $this;
    }

    public function getPrimaryEmotion(): PrimaryEmotion
    {
        return $this->primaryEmotion;
    }

    public function setPrimaryEmotion(PrimaryEmotion $primaryEmotion): static
    {
        $this->primaryEmotion = $primaryEmotion;

        return $this;
    }

    public function getSecondaryEmotion(): SecondaryEmotion
    {
        return $this->secondaryEmotion;
    }

    public function setSecondaryEmotion(SecondaryEmotion $secondaryEmotion): static
    {
        $this->secondaryEmotion = $secondaryEmotion;

        return $this;
    }

    public function getTertiaryEmotion(): TertiaryEmotion
    {
        return $this->tertiaryEmotion;
    }

    public function setTertiaryEmotion(TertiaryEmotion $tertiaryEmotion): static
    {
        $this->tertiaryEmotion = $tertiaryEmotion;

        return $this;
    }

    public function getTriggerEvent(): ?TriggerEvent
    {
        return $this->triggerEvent;
    }

    public function setTriggerEvent(?TriggerEvent $triggerEvent): static
    {
        $this->triggerEvent = $triggerEvent;

        return $this;
    }

    public function toModel(): ModelEmotionLog
    {
        return new ModelEmotionLog(
            id: $this->id,
            primaryEmotion: $this->primaryEmotion->toModel(),
            secondaryEmotion: $this->secondaryEmotion->toModel(),
            tertiaryEmotion: $this->tertiaryEmotion->toModel(),
            date: \DateTimeImmutable::createFromTimestamp($this->date),
            comment: $this->comment,
            triggerEvent: $this->triggerEvent->toModel()
        );
    }

    public static function fromModel(ModelEmotionLog $model): EmotionLog
    {
        return new EmotionLog(
            id: $model->getId(),
            date: $model->getDate()->getTimestamp(),
            primaryEmotion: PrimaryEmotion::fromModel($model->getPrimaryEmotion()),
            secondaryEmotion: SecondaryEmotion::fromModel($model->getSecondaryEmotion()),
            tertiaryEmotion: TertiaryEmotion::fromModel($model->getTertiaryEmotion())
        );
    }
}

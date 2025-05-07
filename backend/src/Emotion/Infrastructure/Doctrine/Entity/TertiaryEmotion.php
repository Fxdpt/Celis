<?php

namespace App\Emotion\Infrastructure\Doctrine\Entity;

use App\Emotion\Infrastructure\Repository\TertiaryEmotionRepository;
use App\Emotion\Domain\Model\TertiaryEmotion\TertiaryEmotion as ModelTertiaryEmotion;
use App\Emotion\Domain\Model\EmotionLog as ModelEmotionLog;
use App\Emotion\Infrastructure\EnumConverter\TertiaryEmotionLabelConverter;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

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
        /**
         * @var Collection<int, EmotionLog>
         */
        #[ORM\OneToMany(targetEntity: EmotionLog::class, mappedBy: 'primaryEmotion', orphanRemoval: true)]
        private Collection $emotionLogs = new ArrayCollection()
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

    /**
     * @return Collection<int, EmotionLog>
     */
    public function getEmotionLog(): Collection
    {
        return $this->emotionLogs;
    }

    public function addEmotionLog(EmotionLog $emotionLog): static
    {
        if (!$this->emotionLogs->contains($emotionLog)) {
            $this->emotionLogs->add($emotionLog);
            $emotionLog->setTertiaryEmotion($this);
        }

        return $this;
    }

    public function removeEmotionLog(EmotionLog $emotionLog): static
    {
        $this->emotionLogs->removeElement($emotionLog);

        return $this;
    }

    public function toModel(): ModelTertiaryEmotion
    {
        $emotionLogs = array_map(
            fn (EmotionLog $emotionLog) => $emotionLog->toModel(),
            $this->emotionLogs->getValues()
        );

        return new ModelTertiaryEmotion(
            id: $this->id,
            emotionLabel: TertiaryEmotionLabelConverter::toEnum($this->emotionLabel),
            emotionLogs: $emotionLogs
        );
    }

    public static function fromModel(ModelTertiaryEmotion $model): TertiaryEmotion
    {
        $emotionLogs = new ArrayCollection();
        array_map(
            function (ModelEmotionLog $emotionLog) use ($emotionLogs) {
                $emotionLogs->add(EmotionLog::fromModel($emotionLog));
            },
            $model->getEmotionLogs()
        );

        return new TertiaryEmotion(
            $model->getId(),
            emotionLabel: TertiaryEmotionLabelConverter::toString($model->getEmotionLabel()),
            emotionLogs: $emotionLogs
        );
    }
}

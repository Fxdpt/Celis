<?php

namespace App\Emotion\Infrastructure\Doctrine\Entity;

use App\Emotion\Domain\Model\EmotionLog as ModelEmotionLog;
use App\Emotion\Domain\Model\PrimaryEmotion\PrimaryEmotion as ModelPrimaryEmotion;
use App\Emotion\Domain\Model\PrimaryEmotion\PrimaryEmotionLabelEnum;
use App\Emotion\Infrastructure\Doctrine\Entity\EmotionLog;
use App\Emotion\Infrastructure\Repository\PrimaryEmotionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    public function getEmotionLogs(): Collection
    {
        return $this->emotionLogs;
    }

    public function addEmotionLog(EmotionLog $emotionLog): static
    {
        if (!$this->emotionLogs->contains($emotionLog)) {
            $this->emotionLogs->add($emotionLog);
            $emotionLog->setPrimaryEmotion($this);
        }

        return $this;
    }

    public function removeEmotionLog(EmotionLog $emotionLog): static
    {
        $this->emotionLogs->removeElement($emotionLog);

        return $this;
    }

    public function toModel(): ModelPrimaryEmotion
    {
        $emotionLogs = array_map(
            fn (EmotionLog $emotionLog) => $emotionLog->toModel(),
            $this->emotionLogs->getValues()
        );

        return new ModelPrimaryEmotion(
            id: $this->id,
            emotionLabel: PrimaryEmotionLabelEnum::tryFrom(strtolower($this->emotionLabel)),
            emotionLogs: $emotionLogs
        );
    }

    public static function fromModel(ModelPrimaryEmotion $model): PrimaryEmotion
    {
        $emotionLogs = new ArrayCollection();
        array_map(
            function (ModelEmotionLog $emotionLog) use ($emotionLogs) {
                $emotionLogs->add(EmotionLog::fromModel($emotionLog));
            },
            $model->getEmotionLogs()
        );

        return new PrimaryEmotion(
            $model->getId(),
            emotionLabel: $model->getEmotionLabel()->value,
            emotionLogs: $emotionLogs
        );
    }
}

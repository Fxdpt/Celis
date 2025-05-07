<?php

namespace App\Emotion\Infrastructure\Doctrine\Entity;

use App\Emotion\Domain\Model\TriggerEvent as ModelTriggerEvent;
use App\Emotion\Domain\Model\EmotionLog as ModelEmotionLog;
use App\Emotion\Infrastructure\Repository\TriggerEventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
        /**
         * @var Collection<int, EmotionLog>
         */
        #[ORM\OneToMany(targetEntity: EmotionLog::class, mappedBy: 'triggerEvent', orphanRemoval: true)]
        private Collection $emotionLogs = new ArrayCollection()
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
            $emotionLog->setTriggerEvent($this);
        }

        return $this;
    }

    public function removeEmotionLog(EmotionLog $emotionLog): static
    {
        if ($this->emotionLogs->removeElement($emotionLog)) {
            // set the owning side to null (unless already changed)
            if ($emotionLog->getTriggerEvent() === $this) {
                $emotionLog->setTriggerEvent(null);
            }
        }

        return $this;
    }

    public function toModel(): ModelTriggerEvent
    {
        $emotionLogs = array_map(
            fn (EmotionLog $emotionLog) => $emotionLog->toModel(),
            $this->emotionLogs->getValues()
        );

        return new ModelTriggerEvent(
            id: $this->id,
            name: $this->name,
            emotionLogs: $emotionLogs
        );
    }

    public static function fromModel(ModelTriggerEvent $model): TriggerEvent
    {
        $emotionLogs = new ArrayCollection();
        array_map(
            function (ModelEmotionLog $emotionLog) use ($emotionLogs) {
                $emotionLogs->add(EmotionLog::fromModel($emotionLog));
            },
            $model->getEmotionLogs()
        );

        return new TriggerEvent(
            id: $model->getId(),
            name: $model->getName(),
            emotionLogs: $emotionLogs
        );
    }
}

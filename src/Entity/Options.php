<?php

namespace App\Entity;

use App\Repository\OptionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OptionsRepository::class)
 */
class Options
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Polls::class, inversedBy="options")
     * @ORM\JoinColumn(nullable=false)
     */
    private $polls;

    /**
     * @ORM\OneToMany(targetEntity=PollAnswers::class, mappedBy="option")
     */
    private $pollAnswers;

    public function __construct()
    {
        $this->pollAnswers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPolls(): ?Polls
    {
        return $this->polls;
    }

    public function setPolls(?Polls $polls): self
    {
        $this->polls = $polls;

        return $this;
    }

    /**
     * @return Collection|PollAnswers[]
     */
    public function getPollAnswers(): Collection
    {
        return $this->pollAnswers;
    }

    public function addPollAnswer(PollAnswers $pollAnswer): self
    {
        if (!$this->pollAnswers->contains($pollAnswer)) {
            $this->pollAnswers[] = $pollAnswer;
            $pollAnswer->setOption($this);
        }

        return $this;
    }

    public function removePollAnswer(PollAnswers $pollAnswer): self
    {
        if ($this->pollAnswers->contains($pollAnswer)) {
            $this->pollAnswers->removeElement($pollAnswer);
            // set the owning side to null (unless already changed)
            if ($pollAnswer->getOption() === $this) {
                $pollAnswer->setOption(null);
            }
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\PollsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PollsRepository::class)
 */
class Polls
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
    private $title;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hide;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="polls")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;

    /**
     * @ORM\OneToMany(targetEntity=Options::class, cascade={"persist", "remove"}, mappedBy="polls")
     */
    private $options;

    /**
     * @ORM\ManyToOne(targetEntity=Countries::class, inversedBy="polls")
     * @ORM\JoinColumn(nullable=false)
     */
    private $country;

    /**
     * @ORM\OneToMany(targetEntity=PollAnswers::class, cascade={"persist", "remove"}, mappedBy="poll")
     */
    private $pollAnswers;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreation;

    public function __construct()
    {
        $this->options = new ArrayCollection();
        $this->pollAnswers = new ArrayCollection();
        $this->dateCreation = new \DateTime(`now`);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getHide(): ?bool
    {
        return $this->hide;
    }

    public function setHide(bool $hide): self
    {
        $this->hide = $hide;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return Collection|Options[]
     */
    public function getOptions(): Collection
    {
        return $this->options;
    }

    public function addOptions(Options $options): self
    {
        if (!$this->options->contains($options)) {
            $this->options[] = $options;
            $options->setPolls($this);
        }

        return $this;
    }

    public function removeOptions(Options $options): self
    {
        if ($this->options->contains($options)) {
            $this->options->removeElement($options);
            // set the owning side to null (unless already changed)
            if ($options->getPolls() === $this) {
                $options->setPolls(null);
            }
        }

        return $this;
    }

    public function getCountry(): ?Countries
    {
        return $this->country;
    }

    public function setCountry(?Countries $country): self
    {
        $this->country = $country;

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
            $pollAnswer->setPoll($this);
        }

        return $this;
    }

    public function removePollAnswer(PollAnswers $pollAnswer): self
    {
        if ($this->pollAnswers->contains($pollAnswer)) {
            $this->pollAnswers->removeElement($pollAnswer);
            // set the owning side to null (unless already changed)
            if ($pollAnswer->getPoll() === $this) {
                $pollAnswer->setPoll(null);
            }
        }

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function __toString()
    {
        return $this->title;
    }
}

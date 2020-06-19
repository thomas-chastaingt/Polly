<?php

namespace App\Entity;

use App\Repository\DepartmentsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DepartmentsRepository::class)
 */
class Departments
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Countries::class, inversedBy="departments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $country;

    /**
     * @ORM\OneToMany(targetEntity=PollAnswers::class, mappedBy="department")
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

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function setCode(int $code): self
    {
        $this->code = $code;

        return $this;
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
            $pollAnswer->setDepartment($this);
        }

        return $this;
    }

    public function removePollAnswer(PollAnswers $pollAnswer): self
    {
        if ($this->pollAnswers->contains($pollAnswer)) {
            $this->pollAnswers->removeElement($pollAnswer);
            // set the owning side to null (unless already changed)
            if ($pollAnswer->getDepartment() === $this) {
                $pollAnswer->setDepartment(null);
            }
        }

        return $this;
    }
}

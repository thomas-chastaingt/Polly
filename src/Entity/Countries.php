<?php

namespace App\Entity;

use App\Repository\CountriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CountriesRepository::class)
 */
class Countries
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
     * @ORM\OneToMany(targetEntity=Polls::class, mappedBy="country")
     */
    private $polls;

    /**
     * @ORM\OneToMany(targetEntity=Departments::class, mappedBy="country")
     */
    private $departments;

    public function __construct()
    {
        $this->polls = new ArrayCollection();
        $this->departments = new ArrayCollection();
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

    /**
     * @return Collection|Polls[]
     */
    public function getPolls(): Collection
    {
        return $this->polls;
    }

    public function addPoll(Polls $poll): self
    {
        if (!$this->polls->contains($poll)) {
            $this->polls[] = $poll;
            $poll->setCountry($this);
        }

        return $this;
    }

    public function removePoll(Polls $poll): self
    {
        if ($this->polls->contains($poll)) {
            $this->polls->removeElement($poll);
            // set the owning side to null (unless already changed)
            if ($poll->getCountry() === $this) {
                $poll->setCountry(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Departments[]
     */
    public function getDepartments(): Collection
    {
        return $this->departments;
    }

    public function addDepartment(Departments $department): self
    {
        if (!$this->departments->contains($department)) {
            $this->departments[] = $department;
            $department->setCountry($this);
        }

        return $this;
    }

    public function removeDepartment(Departments $department): self
    {
        if ($this->departments->contains($department)) {
            $this->departments->removeElement($department);
            // set the owning side to null (unless already changed)
            if ($department->getCountry() === $this) {
                $department->setCountry(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}

<?php

namespace App\Entity;

use App\Repository\PollAnswersRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PollAnswersRepository::class)
 */
class PollAnswers
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Polls::class, inversedBy="pollAnswers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $poll;

    /**
     * @ORM\ManyToOne(targetEntity=Options::class, inversedBy="pollAnswers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $option;

    /**
     * @ORM\ManyToOne(targetEntity=Departments::class, inversedBy="pollAnswers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $department;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPoll(): ?Polls
    {
        return $this->poll;
    }

    public function setPoll(?Polls $poll): self
    {
        $this->poll = $poll;

        return $this;
    }

    public function getOption(): ?Options
    {
        return $this->option;
    }

    public function setOption(?Options $option): self
    {
        $this->option = $option;

        return $this;
    }

    public function getDepartment(): ?Departments
    {
        return $this->department;
    }

    public function setDepartment(?Departments $department): self
    {
        $this->department = $department;

        return $this;
    }

    public function __toString()
    {
        return $this->id;
    }
}

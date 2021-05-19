<?php

namespace App\Entity;

use App\Repository\TraducRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TraducRepository::class)
 */
class traduc
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $ProjectId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $source;

    /**
     * @ORM\ManyToOne(targetEntity=users::class, inversedBy="traduc")
     * @ORM\JoinColumn(nullable=false)
     */
    private $users;

    /**
     * @ORM\ManyToOne(targetEntity=Projects::class, inversedBy="traduc")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Projects;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProjectId(): ?int
    {
        return $this->ProjectId;
    }

    public function setProjectId(int $ProjectId): self
    {
        $this->ProjectId = $ProjectId;

        return $this;
    }

    public function getSource(): ?string
    {
        return $this->source;
    }

    public function setSource(string $source): self
    {
        $this->source = $source;

        return $this;
    }

    public function getUsers(): ?users
    {
        return $this->users;
    }

    public function setUsers(?users $users): self
    {
        $this->users = $users;

        return $this;
    }

    public function getProjects(): ?Projects
    {
        return $this->Projects;
    }

    public function setProjects(?Projects $Projects): self
    {
        $this->Projects = $Projects;

        return $this;
    }
}

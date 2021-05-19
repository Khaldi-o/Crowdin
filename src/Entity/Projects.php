<?php

namespace App\Entity;

use App\Repository\ProjectsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProjectsRepository::class)
 */
class Projects
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
    private $UserId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $LangCode;

    /**
     * @ORM\ManyToOne(targetEntity=Projects::class, inversedBy="projects")
     */
    private $relation;

    /**
     * @ORM\OneToMany(targetEntity=Projects::class, mappedBy="relation")
     */
    private $projects;

    /**
     * @ORM\OneToMany(targetEntity=TraducSource::class, mappedBy="Projects")
     */
    private $traducSources;

    public function __construct()
    {
        $this->projects = new ArrayCollection();
        $this->traducSources = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->UserId;
    }

    public function setUserId(int $UserId): self
    {
        $this->UserId = $UserId;

        return $this;
    }

    public function getLangCode(): ?string
    {
        return $this->LangCode;
    }

    public function setLangCode(string $LangCode): self
    {
        $this->LangCode = $LangCode;

        return $this;
    }

    public function getRelation(): ?self
    {
        return $this->relation;
    }

    public function setRelation(?self $relation): self
    {
        $this->relation = $relation;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(self $project): self
    {
        if (!$this->projects->contains($project)) {
            $this->projects[] = $project;
            $project->setRelation($this);
        }

        return $this;
    }

    public function removeProject(self $project): self
    {
        if ($this->projects->removeElement($project)) {
            // set the owning side to null (unless already changed)
            if ($project->getRelation() === $this) {
                $project->setRelation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|TraducSource[]
     */
    public function getTraducSources(): Collection
    {
        return $this->traducSources;
    }

    public function addTraducSource(TraducSource $traducSource): self
    {
        if (!$this->traducSources->contains($traducSource)) {
            $this->traducSources[] = $traducSource;
            $traducSource->setProjects($this);
        }

        return $this;
    }

    public function removeTraducSource(TraducSource $traducSource): self
    {
        if ($this->traducSources->removeElement($traducSource)) {
            // set the owning side to null (unless already changed)
            if ($traducSource->getProjects() === $this) {
                $traducSource->setProjects(null);
            }
        }

        return $this;
    }
}

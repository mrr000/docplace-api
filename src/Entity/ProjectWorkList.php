<?php

namespace App\Entity;

use App\Repository\ProjectWorkListRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectWorkListRepository::class)]
class ProjectWorkList
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime_immutable')]
    private $createdAt;

    #[ORM\Column(type: 'string', length: 2056)]
    private $comment;

    #[ORM\Column(type: 'boolean')]
    private $isCoordinatedByCustomer;

    #[ORM\Column(type: 'boolean')]
    private $isCoordinatedByMaster;

    #[ORM\ManyToOne(targetEntity: Project::class, inversedBy: 'workLists')]
    #[ORM\JoinColumn(nullable: false)]
    private $project;

    #[ORM\OneToMany(mappedBy: 'workList', targetEntity: ProjectWorkListPosition::class, orphanRemoval: true)]
    private $positions;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->positions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function isIsCoordinatedByCustomer(): ?bool
    {
        return $this->isCoordinatedByCustomer;
    }

    public function setIsCoordinatedByCustomer(bool $isCoordinatedByCustomer): self
    {
        $this->isCoordinatedByCustomer = $isCoordinatedByCustomer;

        return $this;
    }

    public function isIsCoordinatedByMaster(): ?bool
    {
        return $this->isCoordinatedByMaster;
    }

    public function setIsCoordinatedByMaster(bool $isCoordinatedByMaster): self
    {
        $this->isCoordinatedByMaster = $isCoordinatedByMaster;

        return $this;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): self
    {
        $this->project = $project;

        return $this;
    }

    /**
     * @return Collection<int, ProjectWorkListPosition>
     */
    public function getPositions(): Collection
    {
        return $this->positions;
    }

    public function addPosition(ProjectWorkListPosition $position): self
    {
        if (!$this->positions->contains($position)) {
            $this->positions[] = $position;
            $position->setWorkList($this);
        }

        return $this;
    }

    public function removePosition(ProjectWorkListPosition $position): self
    {
        if ($this->positions->removeElement($position)) {
            // set the owning side to null (unless already changed)
            if ($position->getWorkList() === $this) {
                $position->setWorkList(null);
            }
        }

        return $this;
    }
}

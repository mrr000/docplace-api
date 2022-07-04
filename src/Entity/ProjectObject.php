<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
class ProjectObject
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name = '';

    #[ORM\Column(type: 'string', length: 1024)]
    private string $comment = '';

    #[ORM\Column(type: 'string', length: 1024)]
    private string $area = '';

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTime $workStartDate = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTime $workEndDate = null;

    #[ORM\Column(type: 'boolean')]
    private bool $isComplete = false;

    #[ORM\ManyToOne(targetEntity: Project::class, inversedBy: 'objects')]
    #[ORM\JoinColumn(nullable: false)]
    private Project $project;

    /** @var ArrayCollection  */
    #[ORM\ManyToMany(targetEntity: Address::class)]
    #[ORM\JoinTable(name: 'project_object_address')]
    private $addresses;

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

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getWorkStartDate(): ?\DateTimeInterface
    {
        return $this->workStartDate;
    }

    public function setWorkStartDate(?\DateTimeInterface $workStartDate): self
    {
        $this->workStartDate = $workStartDate;

        return $this;
    }

    public function getWorkEndDate(): ?\DateTimeInterface
    {
        return $this->workEndDate;
    }

    public function setWorkEndDate(?\DateTimeInterface $workEndDate): self
    {
        $this->workEndDate = $workEndDate;

        return $this;
    }

    public function getArea(): string
    {
        return $this->area;
    }

    public function setArea(string $area): self
    {
        $this->area = $area;
        return $this;
    }

    public function isIsComplete(): ?bool
    {
        return $this->isComplete;
    }

    public function setIsComplete(bool $isComplete): self
    {
        $this->isComplete = $isComplete;

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

    public function getAddresses(): ArrayCollection
    {
        return $this->addresses;
    }

    public function addAddress(Address $address): self
    {
        if (!$this->addresses->contains($address)) {
            $this->addresses->add($address);
        }
        return $this;
    }

    public function removeAddress(Address $address): self
    {
        if ($this->addresses->contains($address)) {
            $this->addresses->removeElement($address);
        }
        return $this;
    }
}

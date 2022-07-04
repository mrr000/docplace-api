<?php

namespace App\Entity;

use App\Repository\ProjectWorkListPositionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectWorkListPositionRepository::class)]
class ProjectWorkListPosition
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: ProjectWorkList::class, inversedBy: 'positions')]
    #[ORM\JoinColumn(nullable: false)]
    private $workList;

    #[ORM\Column(type: 'float')]
    private $price;

    #[ORM\Column(type: 'float')]
    private $amount;

    #[ORM\Column(type: 'float')]
    private $total;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWorkList(): ?ProjectWorkList
    {
        return $this->workList;
    }

    public function setWorkList(?ProjectWorkList $workList): self
    {
        $this->workList = $workList;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(float $total): self
    {
        $this->total = $total;

        return $this;
    }
}

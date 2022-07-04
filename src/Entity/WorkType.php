<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
class WorkType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name = '';

    #[ORM\ManyToOne(targetEntity: UnitOfMeasure::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?UnitOfMeasure $measure = null;

    #[ORM\Column(type: 'float', length: 255)]
    private float $defaultPrice = 0;

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

    public function getMeasure(): ?UnitOfMeasure
    {
        return $this->measure;
    }

    public function setMeasure(?UnitOfMeasure $measure): WorkType
    {
        $this->measure = $measure;
        return $this;
    }

    public function getDefaultPrice(): float|int
    {
        return $this->defaultPrice;
    }

    public function setDefaultPrice(float|int $defaultPrice): WorkType
    {
        $this->defaultPrice = $defaultPrice;
        return $this;
    }
}

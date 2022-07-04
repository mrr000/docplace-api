<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $value = '';

    #[ORM\ManyToOne(targetEntity: ContactType::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $type;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return Contact
     */
    public function setValue(string $value): Contact
    {
        $this->value = $value;
        return $this;
    }

    public function getType(): ?ContactType
    {
        return $this->type;
    }

    public function setType(?ContactType $type): self
    {
        $this->type = $type;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name = '';

    #[ORM\Column(type: 'string', length: 1024)]
    private string $comment = '';

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTime $workStartDate;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTime $workEndDate;

    #[ORM\Column(type: 'boolean')]
    private bool $isComplete;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private User $customer;

    /** @var ArrayCollection  */
    #[ORM\ManyToMany(targetEntity: Address::class)]
    #[ORM\JoinTable(name: 'project_address')]
    private $addresses;

    /** @var ArrayCollection  */
    #[ORM\OneToMany(mappedBy: 'project', targetEntity: ProjectObject::class, orphanRemoval: true)]
    private $objects;

    #[ORM\ManyToOne(targetEntity: ProjectStatus::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ProjectStatus $status;

    #[ORM\OneToMany(mappedBy: 'project', targetEntity: ProjectWorkList::class, orphanRemoval: true)]
    private $workLists;

    public function __construct()
    {
        $this->addresses = new ArrayCollection();
        $this->objects = new ArrayCollection();
        $this->workLists = new ArrayCollection();
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

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getWorkStartDate()
    {
        return $this->workStartDate;
    }

    /**
     * @param mixed $workStartDate
     * @return Project
     */
    public function setWorkStartDate($workStartDate)
    {
        $this->workStartDate = $workStartDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getWorkEndDate()
    {
        return $this->workEndDate;
    }

    /**
     * @param mixed $workEndDate
     * @return Project
     */
    public function setWorkEndDate($workEndDate)
    {
        $this->workEndDate = $workEndDate;
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

    /**
     * @return mixed
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param mixed $customer
     * @return Project
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getAddresses(): ArrayCollection
    {
        return $this->addresses;
    }

    /**
     * @param mixed $address
     * @return Project
     */
    public function addAddress(Address $address): self
    {
        if (!$this->addresses->contains($address)) {
            $this->addresses->add($address);
        }
        return $this;
    }

    /**
     * @param mixed $address
     * @return Project
     */
    public function removeAddress(Address $address): self
    {
        if ($this->addresses->contains($address)) {
            $this->addresses->removeElement($address);
        }
        return $this;
    }

    /**
     * @return Collection<int, ProjectObject>
     */
    public function getObjects(): Collection
    {
        return $this->objects;
    }

    public function addObject(ProjectObject $object): self
    {
        if (!$this->objects->contains($object)) {
            $this->objects[] = $object;
            $object->setProject($this);
        }

        return $this;
    }

    public function removeObject(ProjectObject $object): self
    {
        if ($this->objects->removeElement($object)) {
            // set the owning side to null (unless already changed)
            if ($object->getProject() === $this) {
                $object->setProject(null);
            }
        }

        return $this;
    }

    public function getStatus(): ?ProjectStatus
    {
        return $this->status;
    }

    public function setStatus(?ProjectStatus $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, ProjectWorkList>
     */
    public function getWorkLists(): Collection
    {
        return $this->workLists;
    }

    public function addWorkList(ProjectWorkList $workList): self
    {
        if (!$this->workLists->contains($workList)) {
            $this->workLists[] = $workList;
            $workList->setProject($this);
        }

        return $this;
    }

    public function removeWorkList(ProjectWorkList $workList): self
    {
        if ($this->workLists->removeElement($workList)) {
            // set the owning side to null (unless already changed)
            if ($workList->getProject() === $this) {
                $workList->setProject(null);
            }
        }

        return $this;
    }
}

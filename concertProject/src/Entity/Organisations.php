<?php

namespace App\Entity;

use App\Repository\OrganisationsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrganisationsRepository::class)
 */
class Organisations
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\OneToMany(targetEntity=Concerts::class, mappedBy="organisation")
     */
    private $concert;

    public function __construct()
    {
        $this->concert = new ArrayCollection();
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

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return Collection|Concerts[]
     */
    public function getConcert(): Collection
    {
        return $this->concert;
    }

    public function addConcert(Concerts $concert): self
    {
        if (!$this->concert->contains($concert)) {
            $this->concert[] = $concert;
            $concert->setOrganisation($this);
        }

        return $this;
    }

    public function removeConcert(Concerts $concert): self
    {
        if ($this->concert->removeElement($concert)) {
            // set the owning side to null (unless already changed)
            if ($concert->getOrganisation() === $this) {
                $concert->setOrganisation(null);
            }
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\BandsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BandsRepository::class)
 */
class Bands
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
     * @ORM\OneToMany(targetEntity=Artists::class, mappedBy="band")
     */
    private $artists;

    /**
     * @ORM\OneToMany(targetEntity=Concerts::class, mappedBy="band")
     */
    private $concert;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $picture;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $kind;

    /**
     * @ORM\Column(type="integer")
     */
    private $yearCreation;

    public function __construct()
    {
        $this->artists = new ArrayCollection();
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

    /**
     * @return Collection|Artists[]
     */
    public function getArtists(): Collection
    {
        return $this->artists;
    }

    public function addArtist(Artists $artist): self
    {
        if (!$this->artists->contains($artist)) {
            $this->artists[] = $artist;
            $artist->setBand($this);
        }

        return $this;
    }

    public function removeArtist(Artists $artist): self
    {
        if ($this->artists->removeElement($artist)) {
            // set the owning side to null (unless already changed)
            if ($artist->getBand() === $this) {
                $artist->setBand(null);
            }
        }

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
            $concert->setBand($this);
        }

        return $this;
    }

    public function removeConcert(Concerts $concert): self
    {
        if ($this->concert->removeElement($concert)) {
            // set the owning side to null (unless already changed)
            if ($concert->getBand() === $this) {
                $concert->setBand(null);
            }
        }

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getKind(): ?string
    {
        return $this->kind;
    }

    public function setKind(string $kind): self
    {
        $this->kind = $kind;

        return $this;
    }

    public function getYearCreation(): ?int
    {
        return $this->yearCreation;
    }

    public function setYearCreation(int $yearCreation): self
    {
        $this->yearCreation = $yearCreation;

        return $this;
    }
}

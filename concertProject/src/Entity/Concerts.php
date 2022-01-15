<?php

namespace App\Entity;

use App\Repository\ConcertsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ConcertsRepository::class)
 */
class Concerts
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $begin;

    /**
     * @ORM\Column(type="datetime")
     */
    private $end;

    /**
     * @ORM\ManyToOne(targetEntity=Rooms::class)
     */
    private $room;

    /**
     * @ORM\ManyToOne(targetEntity=Organisations::class, inversedBy="concert")
     */
    private $organisation;

    /**
     * @ORM\ManyToOne(targetEntity=Bands::class, inversedBy="concert")
     */
    private $band;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBegin(): ?\DateTimeInterface
    {
        return $this->begin;
    }

    public function setBegin(\DateTimeInterface $begin): self
    {
        $this->begin = $begin;

        return $this;
    }

    public function getEnd(): ?\DateTimeInterface
    {
        return $this->end;
    }

    public function setEnd(\DateTimeInterface $end): self
    {
        $this->end = $end;

        return $this;
    }

    public function getRoom(): ?Rooms
    {
        return $this->room;
    }

    public function setRoom(?Rooms $room): self
    {
        $this->room = $room;

        return $this;
    }

    public function getOrganisation(): ?Organisations
    {
        return $this->organisation;
    }

    public function setOrganisation(?Organisations $organisation): self
    {
        $this->organisation = $organisation;

        return $this;
    }

    public function getBand(): ?Bands
    {
        return $this->band;
    }

    public function setBand(?Bands $band): self
    {
        $this->band = $band;

        return $this;
    }


}

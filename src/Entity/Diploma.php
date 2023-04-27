<?php

namespace App\Entity;

use App\Repository\DiplomaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DiplomaRepository::class)]
class Diploma
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $school = null;

    #[ORM\Column(length: 255)]
    private ?string $date_from = null;

    #[ORM\Column(length: 255)]
    private ?string $date_to = null;

    #[ORM\Column(length: 255)]
    private ?string $location = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

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

    public function getSchool(): ?string
    {
        return $this->school;
    }

    public function setSchool(string $school): self
    {
        $this->school = $school;

        return $this;
    }

    public function getDateFrom(): ?string
    {
        return $this->date_from;
    }

    public function setDateFrom(string $date_from): self
    {
        $this->date_from = $date_from;

        return $this;
    }

    public function getDateTo(): ?string
    {
        return $this->date_to;
    }

    public function setDateTo(string $date_to): self
    {
        $this->date_to = $date_to;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}

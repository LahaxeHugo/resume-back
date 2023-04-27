<?php

namespace App\Entity;

use App\Repository\ExperienceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExperienceRepository::class)]
class Experience
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $company = null;

    #[ORM\Column(length: 255)]
    private ?string $date_from = null;

    #[ORM\Column(length: 255)]
    private ?string $date_to = null;

    #[ORM\Column(length: 255)]
    private ?string $location = null;

    #[ORM\OneToMany(mappedBy: 'experience', targetEntity: ExperienceDetail::class, orphanRemoval: true)]
    private Collection $experienceDetails;

    public function __construct()
    {
        $this->experienceDetails = new ArrayCollection();
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

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(string $company): self
    {
        $this->company = $company;

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

    /**
     * @return Collection<int, ExperienceDetail>
     */
    public function getExperienceDetails(): Collection
    {
        return $this->experienceDetails;
    }

    public function addExperienceDetail(ExperienceDetail $experienceDetail): self
    {
        if (!$this->experienceDetails->contains($experienceDetail)) {
            $this->experienceDetails->add($experienceDetail);
            $experienceDetail->setExperience($this);
        }

        return $this;
    }

    public function removeExperienceDetail(ExperienceDetail $experienceDetail): self
    {
        if ($this->experienceDetails->removeElement($experienceDetail)) {
            // set the owning side to null (unless already changed)
            if ($experienceDetail->getExperience() === $this) {
                $experienceDetail->setExperience(null);
            }
        }

        return $this;
    }
}

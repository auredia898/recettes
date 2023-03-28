<?php

namespace App\Entity;

use App\Repository\GuideRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GuideRepository::class)]
class Guide
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column]
    private ?int $expert_year = null;

    #[ORM\Column(length: 255)]
    private ?string $cv = null;

    #[ORM\ManyToOne(inversedBy: 'guides')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CategoriesGuide $category = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getExpertYear(): ?int
    {
        return $this->expert_year;
    }

    public function setExpertYear(int $expert_year): self
    {
        $this->expert_year = $expert_year;

        return $this;
    }

    public function getCv(): ?string
    {
        return $this->cv;
    }

    public function setCv(string $cv): self
    {
        $this->cv = $cv;

        return $this;
    }

    public function getCategory(): ?CategoriesGuide
    {
        return $this->category;
    }

    public function setCategory(?CategoriesGuide $category): self
    {
        $this->category = $category;

        return $this;
    }
}

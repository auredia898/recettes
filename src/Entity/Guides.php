<?php

namespace App\Entity;

use App\Repository\GuidesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GuidesRepository::class)]
class Guides
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $Experiences = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExperiences(): ?int
    {
        return $this->Experiences;
    }

    public function setExperiences(int $Experiences): self
    {
        $this->Experiences = $Experiences;

        return $this;
    }
}

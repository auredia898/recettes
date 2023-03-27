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
    private ?int $anneeExp = null;

    #[ORM\Column]
    private ?int $anneeResidence = null;

    #[ORM\Column(length: 255)]
    private ?string $cv = null;

    #[ORM\ManyToOne(inversedBy: 'guides')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CategorieGuide $idCatGuide = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnneeExp(): ?int
    {
        return $this->anneeExp;
    }

    public function setAnneeExp(int $anneeExp): self
    {
        $this->anneeExp = $anneeExp;

        return $this;
    }

    public function getAnneeResidence(): ?int
    {
        return $this->anneeResidence;
    }

    public function setAnneeResidence(int $anneeResidence): self
    {
        $this->anneeResidence = $anneeResidence;

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

    public function getIdCatGuide(): ?CategorieGuide
    {
        return $this->idCatGuide;
    }

    public function setIdCatGuide(?CategorieGuide $idCatGuide): self
    {
        $this->idCatGuide = $idCatGuide;

        return $this;
    }
}

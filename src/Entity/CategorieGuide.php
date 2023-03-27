<?php

namespace App\Entity;

use App\Repository\CategorieGuideRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieGuideRepository::class)]
class CategorieGuide
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\OneToMany(mappedBy: 'idCatGuide', targetEntity: Guides::class)]
    private Collection $guides;

    public function __construct()
    {
        $this->guides = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection<int, Guides>
     */
    public function getGuides(): Collection
    {
        return $this->guides;
    }

    public function addGuide(Guides $guide): self
    {
        if (!$this->guides->contains($guide)) {
            $this->guides->add($guide);
            $guide->setIdCatGuide($this);
        }

        return $this;
    }

    public function removeGuide(Guides $guide): self
    {
        if ($this->guides->removeElement($guide)) {
            // set the owning side to null (unless already changed)
            if ($guide->getIdCatGuide() === $this) {
                $guide->setIdCatGuide(null);
            }
        }

        return $this;
    }
}

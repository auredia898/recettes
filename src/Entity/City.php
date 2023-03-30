<?php

namespace App\Entity;

use App\Repository\CityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CityRepository::class)]
class City
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'city', targetEntity: TouristicSite::class)]
    private Collection $touristicSites;

    public function __construct()
    {
        $this->touristicSites = new ArrayCollection();
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
     * @return Collection<int, TouristicSite>
     */
    public function getTouristicSites(): Collection
    {
        return $this->touristicSites;
    }

    public function addTouristicSite(TouristicSite $touristicSite): self
    {
        if (!$this->touristicSites->contains($touristicSite)) {
            $this->touristicSites->add($touristicSite);
            $touristicSite->setCity($this);
        }

        return $this;
    }

    public function removeTouristicSite(TouristicSite $touristicSite): self
    {
        if ($this->touristicSites->removeElement($touristicSite)) {
            // set the owning side to null (unless already changed)
            if ($touristicSite->getCity() === $this) {
                $touristicSite->setCity(null);
            }
        }

        return $this;
    }
}

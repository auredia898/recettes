<?php

namespace App\Entity;

use App\Repository\CategoriesGuideRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoriesGuideRepository::class)]
class CategoriesGuide
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Guide::class)]
    private Collection $guides;

    public function __construct()
    {
        $this->guides = new ArrayCollection();
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
     * @return Collection<int, Guide>
     */
    public function getGuides(): Collection
    {
        return $this->guides;
    }

    public function addGuide(Guide $guide): self
    {
        if (!$this->guides->contains($guide)) {
            $this->guides->add($guide);
            $guide->setCategory($this);
        }

        return $this;
    }

    public function removeGuide(Guide $guide): self
    {
        if ($this->guides->removeElement($guide)) {
            // set the owning side to null (unless already changed)
            if ($guide->getCategory() === $this) {
                $guide->setCategory(null);
            }
        }

        return $this;
    }
}

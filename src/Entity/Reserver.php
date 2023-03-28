<?php

namespace App\Entity;

use App\Repository\ReserverRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReserverRepository::class)]
class Reserver
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: reservation::class)]
    private Collection $reservationId;

    #[ORM\ManyToMany(targetEntity: site::class)]
    private Collection $siteId;

    #[ORM\ManyToOne]
    private ?guide $guideId = null;

    public function __construct()
    {
        $this->reservationId = new ArrayCollection();
        $this->siteId = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, reservation>
     */
    public function getReservationId(): Collection
    {
        return $this->reservationId;
    }

    public function addReservationId(reservation $reservationId): self
    {
        if (!$this->reservationId->contains($reservationId)) {
            $this->reservationId->add($reservationId);
        }

        return $this;
    }

    public function removeReservationId(reservation $reservationId): self
    {
        $this->reservationId->removeElement($reservationId);

        return $this;
    }

    /**
     * @return Collection<int, site>
     */
    public function getSiteId(): Collection
    {
        return $this->siteId;
    }

    public function addSiteId(site $siteId): self
    {
        if (!$this->siteId->contains($siteId)) {
            $this->siteId->add($siteId);
        }

        return $this;
    }

    public function removeSiteId(site $siteId): self
    {
        $this->siteId->removeElement($siteId);

        return $this;
    }

    public function getGuideId(): ?guide
    {
        return $this->guideId;
    }

    public function setGuideId(?guide $guideId): self
    {
        $this->guideId = $guideId;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $bookingdate = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBookingdate(): ?\DateTimeInterface
    {
        return $this->bookingdate;
    }

    public function setBookingdate(\DateTimeInterface $bookingdate): self
    {
        $this->bookingdate = $bookingdate;

        return $this;
    }

}

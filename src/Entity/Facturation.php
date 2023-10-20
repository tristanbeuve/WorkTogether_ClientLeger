<?php

namespace App\Entity;

use App\Repository\FacturationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FacturationRepository::class)]
class Facturation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateDeb = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateEnd = null;

    #[ORM\Column]
    private ?int $prix = null;

    #[ORM\ManyToOne(inversedBy: 'facturations')]
    private ?Reservation $IdentifiantReservation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDeb(): ?\DateTimeInterface
    {
        return $this->dateDeb;
    }

    public function setDateDeb(\DateTimeInterface $dateDeb): static
    {
        $this->dateDeb = $dateDeb;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->dateEnd;
    }

    public function setDateEnd(\DateTimeInterface $dateEnd): static
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getIdentifiantReservation(): ?Reservation
    {
        return $this->IdentifiantReservation;
    }

    public function setIdentifiantReservation(?Reservation $IdentifiantReservation): static
    {
        $this->IdentifiantReservation = $IdentifiantReservation;

        return $this;
    }
}

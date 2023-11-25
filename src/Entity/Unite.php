<?php

namespace App\Entity;

use App\Repository\UniteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UniteRepository::class)]
class Unite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?string $numero = null;

    #[ORM\Column]
    private ?bool $status = null;

    #[ORM\ManyToOne(inversedBy: 'unites')]
    private ?TypeUnite $IdentifiantTypeUnite = null;

    #[ORM\ManyToOne(inversedBy: 'unites')]
    private ?Baie $IdentifiantBaie = null;

    #[ORM\ManyToOne(inversedBy: 'unites')]
    private ?Reservation $IdentifiantReservation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): static
    {
        $this->numero = $numero;

        return $this;
    }

    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getIdentifiantTypeUnite(): ?TypeUnite
    {
        return $this->IdentifiantTypeUnite;
    }

    public function setIdentifiantTypeUnite(?TypeUnite $IdentifiantTypeUnite): static
    {
        $this->IdentifiantTypeUnite = $IdentifiantTypeUnite;

        return $this;
    }

    public function getIdentifiantBaie(): ?Baie
    {
        return $this->IdentifiantBaie;
    }

    public function setIdentifiantBaie(?Baie $IdentifiantBaie): static
    {
        $this->IdentifiantBaie = $IdentifiantBaie;

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

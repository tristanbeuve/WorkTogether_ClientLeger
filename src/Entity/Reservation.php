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

    #[ORM\Column]
    private ?int $Numero = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateDeb = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateEnd = null;

    #[ORM\OneToMany(mappedBy: 'IdentifiantReservation', targetEntity: Facturation::class)]
    private Collection $facturations;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?Abonnement $IdentifiantAbonnement = null;

    #[ORM\OneToMany(mappedBy: 'IdentifiantReservation', targetEntity: Unite::class)]
    private Collection $unites;

    public function __construct()
    {
        $this->facturations = new ArrayCollection();
        $this->unites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?int
    {
        return $this->Numero;
    }

    public function setNumero(int $Numero): static
    {
        $this->Numero = $Numero;

        return $this;
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

    /**
     * @return Collection<int, Facturation>
     */
    public function getFacturations(): Collection
    {
        return $this->facturations;
    }

    public function addFacturation(Facturation $facturation): static
    {
        if (!$this->facturations->contains($facturation)) {
            $this->facturations->add($facturation);
            $facturation->setIdentifiantReservation($this);
        }

        return $this;
    }

    public function removeFacturation(Facturation $facturation): static
    {
        if ($this->facturations->removeElement($facturation)) {
            // set the owning side to null (unless already changed)
            if ($facturation->getIdentifiantReservation() === $this) {
                $facturation->setIdentifiantReservation(null);
            }
        }

        return $this;
    }

    public function getIdentifiantAbonnement(): ?Abonnement
    {
        return $this->IdentifiantAbonnement;
    }

    public function setIdentifiantAbonnement(?Abonnement $IdentifiantAbonnement): static
    {
        $this->IdentifiantAbonnement = $IdentifiantAbonnement;

        return $this;
    }

    /**
     * @return Collection<int, Unite>
     */
    public function getUnites(): Collection
    {
        return $this->unites;
    }

    public function addUnite(Unite $unite): static
    {
        if (!$this->unites->contains($unite)) {
            $this->unites->add($unite);
            $unite->setIdentifiantReservation($this);
        }

        return $this;
    }

    public function removeUnite(Unite $unite): static
    {
        if ($this->unites->removeElement($unite)) {
            // set the owning side to null (unless already changed)
            if ($unite->getIdentifiantReservation() === $this) {
                $unite->setIdentifiantReservation(null);
            }
        }

        return $this;
    }
}

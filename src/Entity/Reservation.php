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


    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?Abonnement $IdentifiantAbonnement = null;

    #[ORM\OneToMany(mappedBy: 'IdentifiantReservation', targetEntity: Unite::class)]
    private Collection $unites;

    #[ORM\Column]
    private ?bool $ren_auto = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Renouvellement $Renouvellement = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?User $customer = null;

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

    public function isRenAuto(): ?bool
    {
        return $this->ren_auto;
    }

    public function setRenAuto(bool $ren_auto): static
    {
        $this->ren_auto = $ren_auto;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getRenouvellement(): ?Renouvellement
    {
        return $this->Renouvellement;
    }

    public function setRenouvellement(?Renouvellement $Renouvellement): static
    {
        $this->Renouvellement = $Renouvellement;

        return $this;
    }

    public function getCustomer(): ?User
    {
        return $this->customer;
    }

    public function setCustomer(?User $customer): static
    {
        $this->customer = $customer;

        return $this;
    }
}

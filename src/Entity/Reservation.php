<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


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

    #[ORM\ManyToOne(inversedBy: 'Unite')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Unite $unite = null;

    public function __construct()
    {
        $this->facturations = new ArrayCollection();
        $this->unites = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
//    public function set(): ArrayCollection
//    {
//        return $this->facturations;
//    }
//    public function setDuration($duration) {
//
//        return $this->$dateEnd;
//    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDeb(): ?\DateTimeInterface
    {
        return $this->dateDeb;
    }

    public function setDateDeb(): static
    {
        $this->dateDeb = new DateTime('now');

        return $this;
    }

    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->dateEnd;
    }

    public function setDateEnd(\DateTimeInterface $DateEnd): static
    {
        $this->dateEnd = $DateEnd;

        return $this;
    }

    public function setDateEndForm( \DateInterval $duration): static
    {
        $date = new DateTime('now');
        $dateEnd = $date->add($duration);
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

    public function getUniteId(): ?Unite
    {
        return $this->unite;
    }

    public function setUniteId(?Unite $unite): static
    {
        $this->unite = $unite;

        return $this;
    }
}

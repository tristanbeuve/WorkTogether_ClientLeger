<?php

namespace App\Entity;

use App\Repository\AbonnementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AbonnementRepository::class)]
class Abonnement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?int $prix = null;


    #[ORM\OneToMany(mappedBy: 'IdentifiantAbonnement', targetEntity: Reservation::class)]
    private Collection $reservations;

    #[ORM\Column]
    private ?int $nbr_emplacement = null;

    #[ORM\Column]
    private ?int $reduction = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $img_path = null;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

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

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): static
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setIdentifiantAbonnement($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): static
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getIdentifiantAbonnement() === $this) {
                $reservation->setIdentifiantAbonnement(null);
            }
        }

        return $this;
    }

    public function getNbrEmplacement(): ?int
    {
        return $this->nbr_emplacement;
    }

    public function setNbrEmplacement(int $nbr_emplacement): static
    {
        $this->nbr_emplacement = $nbr_emplacement;

        return $this;
    }

    public function getReduction(): ?int
    {
        return $this->reduction;
    }

    public function setReduction(int $reduction): static
    {
        $this->reduction = $reduction;

        return $this;
    }

    public function getImgPath(): ?string
    {
        return $this->img_path;
    }

    public function setImgPath(?string $img_path): static
    {
        $this->img_path = $img_path;

        return $this;
    }
}

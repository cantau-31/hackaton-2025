<?php

namespace App\Entity;

use App\Repository\PlanningRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlanningRepository::class)]
class Planning
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTime $date = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTime $heure = null;

    #[ORM\Column(length: 100)]
    private ?string $chefChantier = null;

    #[ORM\ManyToOne(inversedBy: 'plannings')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Chantier $chantier = null;

    #[ORM\ManyToMany(targetEntity: Personnel::class)]
    private Collection $employes;
    
    #[ORM\ManyToOne(inversedBy: 'plannings')]
    private ?Personnel $personnel = null;


    public function __construct()
    {
        $this->employes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): static
    {
        $this->date = $date;
        return $this;
    }

    public function getHeure(): ?\DateTime
    {
        return $this->heure;
    }

    public function setHeure(\DateTime $heure): static
    {
        $this->heure = $heure;
        return $this;
    }

    public function getChefChantier(): ?string
    {
        return $this->chefChantier;
    }

    public function setChefChantier(string $chefChantier): static
    {
        $this->chefChantier = $chefChantier;
        return $this;
    }

    public function getChantier(): ?Chantier
    {
        return $this->chantier;
    }

    public function setChantier(?Chantier $chantier): static
    {
        $this->chantier = $chantier;
        return $this;
    }

    public function getEmployes(): Collection
    {
        return $this->employes;
    }

    public function addEmploye(Personnel $employe): static
    {
        if (!$this->employes->contains($employe)) {
            $this->employes[] = $employe;
        }

        return $this;
    }

    public function removeEmploye(Personnel $employe): static
    {
        $this->employes->removeElement($employe);
        return $this;
    }

    public function getPersonnel(): ?Personnel
    {
        return $this->personnel;
    }

    public function setPersonnel(?Personnel $personnel): static
    {
        $this->personnel = $personnel;

        return $this;
    }

}

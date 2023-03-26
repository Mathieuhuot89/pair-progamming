<?php

namespace App\Entity;

use Date;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CommandeRepository;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $montant = null;

    #[ORM\Column]
    private ?int $nbJourLoc = null;

    #[ORM\Column]
    private ?\DateTime $jourDepart = null;

    #[ORM\Column]
    private ?\DateTime $jourArrive = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?bool $status = null;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?user $user = null;

    #[ORM\ManyToOne(inversedBy: 'commandes', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?voiture $voiture = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getNbJourLoc(): ?int
    {
        return $this->nbJourLoc;
    }

    public function setNbJourLoc(int $nbJourLoc): self
    {
        $this->nbJourLoc = $nbJourLoc;

        return $this;
    }

    public function getJourDepart(): ?\DateTime
    {
        return $this->jourDepart;
    }

    public function setJourDepart(\DateTime $jourDepart): self
    {
        $this->jourDepart = $jourDepart;

        return $this;
    }

    public function getJourArrive(): ?\DateTime
    {
        return $this->jourArrive;
    }

    public function setJourArrive(\DateTime $jourArrive): self
    {
        $this->jourArrive = $jourArrive;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getVoiture(): ?voiture
    {
        return $this->voiture;
    }

    public function setVoiture(voiture $voiture): self
    {
        $this->voiture = $voiture;

        return $this;
    }
}

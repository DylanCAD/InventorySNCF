<?php

namespace App\Entity;

use App\Repository\TelRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TelRepository::class)
 */
class Tel
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle_Tel;

    /**
     * @ORM\Column(type="date")
     */
    private $lastModif_Tel;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite_Tel;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="tels")
     */
    private $Utilisateur;

    /**
     * @ORM\ManyToOne(targetEntity=Admin::class, inversedBy="tels")
     */
    private $Admin;

    /**
     * @ORM\ManyToOne(targetEntity=Inventaire::class, inversedBy="tels")
     */
    private $Inventaire;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getLibelleTel(): ?string
    {
        return $this->libelle_Tel;
    }

    public function setLibelleTel(string $libelle_Tel): self
    {
        $this->libelle_Tel = $libelle_Tel;

        return $this;
    }

    public function getLastModifTel(): ?\DateTimeInterface
    {
        return $this->lastModif_Tel;
    }

    public function setLastModifTel(\DateTimeInterface $lastModif_Tel): self
    {
        $this->lastModif_Tel = $lastModif_Tel;

        return $this;
    }

    public function getQuantiteTel(): ?int
    {
        return $this->quantite_Tel;
    }

    public function setQuantiteTel(int $quantite_Tel): self
    {
        $this->quantite_Tel = $quantite_Tel;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->Utilisateur;
    }

    public function setUtilisateur(?Utilisateur $Utilisateur): self
    {
        $this->Utilisateur = $Utilisateur;

        return $this;
    }

    public function getAdmin(): ?Admin
    {
        return $this->Admin;
    }

    public function setAdmin(?Admin $Admin): self
    {
        $this->Admin = $Admin;

        return $this;
    }

    public function getInventaire(): ?Inventaire
    {
        return $this->Inventaire;
    }

    public function setInventaire(?Inventaire $Inventaire): self
    {
        $this->Inventaire = $Inventaire;

        return $this;
    }
}

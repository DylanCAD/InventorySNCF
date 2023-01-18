<?php

namespace App\Entity;

use App\Repository\ObjetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ObjetRepository::class)
 */
class Objet
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
    private $libelle_Objet;

    /**
     * @ORM\Column(type="date")
     */
    private $lastModif_Objet;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite_Objet;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="id_Admin")
     */
    private $Utilisateur;


    /**
     * @ORM\OneToMany(targetEntity=Admin::class, mappedBy="objet")
     */
    private $id_Admin;

    /**
     * @ORM\ManyToOne(targetEntity=Admin::class, inversedBy="objets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Admin;

    /**
     * @ORM\ManyToOne(targetEntity=Inventaire::class, inversedBy="objets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Inventaire;


    public function __construct()
    {
        $this->id_Admin = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleObjet(): ?string
    {
        return $this->libelle_Objet;
    }

    public function setLibelleObjet(string $libelle_Objet): self
    {
        $this->libelle_Objet = $libelle_Objet;

        return $this;
    }

    public function getLastModifObjet(): ?\DateTimeInterface
    {
        return $this->lastModif_Objet;
    }

    public function setLastModifObjet(\DateTimeInterface $lastModif_Objet): self
    {
        $this->lastModif_Objet = $lastModif_Objet;

        return $this;
    }

    public function getQuantiteObjet(): ?int
    {
        return $this->quantite_Objet;
    }

    public function setQuantiteObjet(int $quantite_Objet): self
    {
        $this->quantite_Objet = $quantite_Objet;

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

    /**
     * @return Collection<int, Admin>
     */
    public function getIdAdmin(): Collection
    {
        return $this->id_Admin;
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

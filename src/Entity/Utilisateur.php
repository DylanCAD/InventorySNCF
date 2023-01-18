<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UtilisateurRepository::class)
 */
class Utilisateur
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
    private $nom_Utilisateur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom_Utilisateur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fonction_Utilisateur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mdp_Utilisateur;

    /**
     * @ORM\OneToMany(targetEntity=Objet::class, mappedBy="Utilisateur")
     */
    private $id_Admin;

    /**
     * @ORM\OneToMany(targetEntity=Inventaire::class, mappedBy="id_utilisateur")
     */
    private $inventaires;

    public function __construct()
    {
        $this->id_Admin = new ArrayCollection();
        $this->inventaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomUtilisateur(): ?string
    {
        return $this->nom_Utilisateur;
    }

    public function setNomUtilisateur(string $nom_Utilisateur): self
    {
        $this->nom_Utilisateur = $nom_Utilisateur;

        return $this;
    }

    public function getPrenomUtilisateur(): ?string
    {
        return $this->prenom_Utilisateur;
    }

    public function setPrenomUtilisateur(string $prenom_Utilisateur): self
    {
        $this->prenom_Utilisateur = $prenom_Utilisateur;

        return $this;
    }

    public function getFonctionUtilisateur(): ?string
    {
        return $this->fonction_Utilisateur;
    }

    public function setFonctionUtilisateur(string $fonction_Utilisateur): self
    {
        $this->fonction_Utilisateur = $fonction_Utilisateur;

        return $this;
    }

    public function getMdpUtilisateur(): ?string
    {
        return $this->mdp_Utilisateur;
    }

    public function setMdpUtilisateur(string $mdp_Utilisateur): self
    {
        $this->mdp_Utilisateur = $mdp_Utilisateur;

        return $this;
    }

    /**
     * @return Collection<int, Objet>
     */
    public function getIdAdmin(): Collection
    {
        return $this->id_Admin;
    }

    public function addIdAdmin(Objet $idAdmin): self
    {
        if (!$this->id_Admin->contains($idAdmin)) {
            $this->id_Admin[] = $idAdmin;
            $idAdmin->setUtilisateur($this);
        }

        return $this;
    }

    public function removeIdAdmin(Objet $idAdmin): self
    {
        if ($this->id_Admin->removeElement($idAdmin)) {
            // set the owning side to null (unless already changed)
            if ($idAdmin->getUtilisateur() === $this) {
                $idAdmin->setUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Inventaire>
     */
    public function getInventaires(): Collection
    {
        return $this->inventaires;
    }

    public function addInventaire(Inventaire $inventaire): self
    {
        if (!$this->inventaires->contains($inventaire)) {
            $this->inventaires[] = $inventaire;
            $inventaire->setIdUtilisateur($this);
        }

        return $this;
    }

    public function removeInventaire(Inventaire $inventaire): self
    {
        if ($this->inventaires->removeElement($inventaire)) {
            // set the owning side to null (unless already changed)
            if ($inventaire->getIdUtilisateur() === $this) {
                $inventaire->setIdUtilisateur(null);
            }
        }

        return $this;
    }
}

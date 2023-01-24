<?php

namespace App\Entity;

use App\Repository\AdminRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AdminRepository::class)
 */
class Admin
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
    private $nom_Admin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom_Admin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mdp_Admin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fonction_Admin;

    /**
     * @ORM\OneToMany(targetEntity=Objet::class, mappedBy="Admin")
     */
    private $objets;

    /**
     * @ORM\OneToMany(targetEntity=Tel::class, mappedBy="Admin")
     */
    private $tels;

    public function __construct()
    {
        $this->objets = new ArrayCollection();
        $this->tels = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomAdmin(): ?string
    {
        return $this->nom_Admin;
    }
    
    public function setNomAdmin(string $nom_Admin): self
    {
        $this->nom_Admin = $nom_Admin;

        return $this;
    }

    public function getPrenomAdmin(): ?string
    {
        return $this->prenom_Admin;
    }

    public function setPrenomAdmin(string $prenom_Admin): self
    {
        $this->prenom_Admin = $prenom_Admin;

        return $this;
    }

    public function getMdpAdmin(): ?string
    {
        return $this->mdp_Admin;
    }

    public function setMdpAdmin(string $mdp_Admin): self
    {
        $this->mdp_Admin = $mdp_Admin;

        return $this;
    }

    public function getFonctionAdmin(): ?string
    {
        return $this->fonction_Admin;
    }

    public function setFonctionAdmin(string $fonction_Admin): self
    {
        $this->fonction_Admin = $fonction_Admin;

        return $this;
    }

    /**
     * @return Collection<int, Objet>
     */
    public function getObjets(): Collection
    {
        return $this->objets;
    }

    public function addObjet(Objet $objet): self
    {
        if (!$this->objets->contains($objet)) {
            $this->objets[] = $objet;
            $objet->setAdmin($this);
        }

        return $this;
    }

    public function removeObjet(Objet $objet): self
    {
        if ($this->objets->removeElement($objet)) {
            // set the owning side to null (unless already changed)
            if ($objet->getAdmin() === $this) {
                $objet->setAdmin(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Tel>
     */
    public function getTels(): Collection
    {
        return $this->tels;
    }

    public function addTel(Tel $tel): self
    {
        if (!$this->tels->contains($tel)) {
            $this->tels[] = $tel;
            $tel->setAdmin($this);
        }

        return $this;
    }

    public function removeTel(Tel $tel): self
    {
        if ($this->tels->removeElement($tel)) {
            // set the owning side to null (unless already changed)
            if ($tel->getAdmin() === $this) {
                $tel->setAdmin(null);
            }
        }

        return $this;
    }

}

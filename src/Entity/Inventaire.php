<?php

namespace App\Entity;

use App\Repository\InventaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InventaireRepository::class)
 */
class Inventaire
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
    private $cathegorie_Inventaire;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="inventaires")
     * @ORM\JoinColumn(nullable=true)
     */
    private $utilisateur;

    /**
     * @ORM\OneToMany(targetEntity=Objet::class, mappedBy="Inventaire")
     */
    private $objets;

    /**
     * @ORM\OneToMany(targetEntity=Tel::class, mappedBy="Inventaire")
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

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getCathegorieInventaire(): ?string
    {
        return $this->cathegorie_Inventaire;
    }

    public function setCathegorieInventaire(string $cathegorie_Inventaire): self
    {
        $this->cathegorie_Inventaire = $cathegorie_Inventaire;

        return $this;
    }

    public function getIdUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setIdUtilisateur(?Utilisateur $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

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
            $objet->setInventaire($this);
        }

        return $this;
    }

    public function removeObjet(Objet $objet): self
    {
        if ($this->objets->removeElement($objet)) {
            // set the owning side to null (unless already changed)
            if ($objet->getInventaire() === $this) {
                $objet->setInventaire(null);
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
            $tel->setInventaire($this);
        }

        return $this;
    }

    public function removeTel(Tel $tel): self
    {
        if ($this->tels->removeElement($tel)) {
            // set the owning side to null (unless already changed)
            if ($tel->getInventaire() === $this) {
                $tel->setInventaire(null);
            }
        }

        return $this;
    }
}

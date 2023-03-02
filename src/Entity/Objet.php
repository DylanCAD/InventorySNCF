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
    private $quantite_Objet = 0;




    /**
     * @ORM\ManyToOne(targetEntity=Inventaire::class, inversedBy="objets")
     * @ORM\JoinColumn(nullable=true)
     */
    private $Inventaire;

    /**
     * @ORM\ManyToOne(targetEntity=Appareil::class, inversedBy="objets")
     */
    private $Appareil;

    /**
     * @ORM\ManyToOne(targetEntity=Marque::class, inversedBy="objets")
     */
    private $Marque;

    /**
     * @ORM\ManyToOne(targetEntity=Modele::class, inversedBy="objets")
     */
    private $Modele;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numSerieObjet;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
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

    public function decreaseQuantite(): self
    {
        $this->quantite_Objet--;
        return $this;
    }

    public function increaseQuantite(): self
    {
        $this->quantite_Objet++;
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

    public function getAppareil(): ?Appareil
    {
        return $this->Appareil;
    }

    public function setAppareil(?Appareil $Appareil): self
    {
        $this->Appareil = $Appareil;

        return $this;
    }

    public function getMarque(): ?Marque
    {
        return $this->Marque;
    }

    public function setMarque(?Marque $Marque): self
    {
        $this->Marque = $Marque;

        return $this;
    }

    public function getModele(): ?Modele
    {
        return $this->Modele;
    }

    public function setModele(?Modele $Modele): self
    {
        $this->Modele = $Modele;

        return $this;
    }

    public function getNumSerieObjet(): ?string
    {
        return $this->numSerieObjet;
    }

    public function setNumSerieObjet(?string $numSerieObjet): self
    {
        $this->numSerieObjet = $numSerieObjet;

        return $this;
    }

}

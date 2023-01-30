<?php

namespace App\Entity;

use App\Repository\ModeleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ModeleRepository::class)
 */
class Modele
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nomModele;

    /**
     * @ORM\OneToMany(targetEntity=Objet::class, mappedBy="Modele")
     */
    private $objets;

    /**
     * @ORM\OneToMany(targetEntity=Tel::class, mappedBy="Modele")
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

    public function getNomModele(): ?string
    {
        return $this->nomModele;
    }

    public function setNomModele(?string $nomModele): self
    {
        $this->nomModele = $nomModele;

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
            $objet->setModele($this);
        }

        return $this;
    }

    public function removeObjet(Objet $objet): self
    {
        if ($this->objets->removeElement($objet)) {
            // set the owning side to null (unless already changed)
            if ($objet->getModele() === $this) {
                $objet->setModele(null);
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
            $tel->setModele($this);
        }

        return $this;
    }

    public function removeTel(Tel $tel): self
    {
        if ($this->tels->removeElement($tel)) {
            // set the owning side to null (unless already changed)
            if ($tel->getModele() === $this) {
                $tel->setModele(null);
            }
        }

        return $this;
    }
}

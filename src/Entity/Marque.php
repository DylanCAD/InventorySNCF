<?php

namespace App\Entity;

use App\Repository\MarqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MarqueRepository::class)
 */
class Marque
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
    private $nomMarque;

    /**
     * @ORM\OneToMany(targetEntity=Objet::class, mappedBy="Marque")
     */
    private $objets;

    /**
     * @ORM\OneToMany(targetEntity=Tel::class, mappedBy="Marque")
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

    public function getNomMarque(): ?string
    {
        return $this->nomMarque;
    }

    public function setNomMarque(string $nomMarque): self
    {
        $this->nomMarque = $nomMarque;

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
            $objet->setMarque($this);
        }

        return $this;
    }

    public function removeObjet(Objet $objet): self
    {
        if ($this->objets->removeElement($objet)) {
            // set the owning side to null (unless already changed)
            if ($objet->getMarque() === $this) {
                $objet->setMarque(null);
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
            $tel->setMarque($this);
        }

        return $this;
    }

    public function removeTel(Tel $tel): self
    {
        if ($this->tels->removeElement($tel)) {
            // set the owning side to null (unless already changed)
            if ($tel->getMarque() === $this) {
                $tel->setMarque(null);
            }
        }

        return $this;
    }
}

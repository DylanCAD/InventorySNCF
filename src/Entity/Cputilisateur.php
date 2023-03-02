<?php

namespace App\Entity;

use App\Repository\CputilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CputilisateurRepository::class)
 */
class Cputilisateur
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
    private $nomCputilisateur;

    /**
     * @ORM\OneToMany(targetEntity=Tel::class, mappedBy="Cputilisateur")
     */
    private $tels;

    /**
     * @ORM\ManyToOne(targetEntity=Cpchemin::class, inversedBy="cputilisateurs")
     */
    private $Cpchemin;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $datecputilisateur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $idprodtel;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $idprodobjet;

    public function __construct()
    {
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

    public function getNomCputilisateur(): ?string
    {
        return $this->nomCputilisateur;
    }

    public function setNomCputilisateur(?string $nomCputilisateur): self
    {
        $this->nomCputilisateur = $nomCputilisateur;

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
            $tel->setCputilisateur($this);
        }

        return $this;
    }

    public function removeTel(Tel $tel): self
    {
        if ($this->tels->removeElement($tel)) {
            // set the owning side to null (unless already changed)
            if ($tel->getCputilisateur() === $this) {
                $tel->setCputilisateur(null);
            }
        }

        return $this;
    }

    public function getCpchemin(): ?Cpchemin
    {
        return $this->Cpchemin;
    }

    public function setCpchemin(?Cpchemin $Cpchemin): self
    {
        $this->Cpchemin = $Cpchemin;

        return $this;
    }

    public function getDatecputilisateur(): ?\DateTimeInterface
    {
        return $this->datecputilisateur;
    }

    public function setDatecputilisateur(?\DateTimeInterface $datecputilisateur): self
    {
        $this->datecputilisateur = $datecputilisateur;

        return $this;
    }

    public function getIdprodtel(): ?string
    {
        return $this->idprodtel;
    }

    public function setIdprodtel(?string $idprodtel): self
    {
        $this->idprodtel = $idprodtel;

        return $this;
    }

    public function getIdprodobjet(): ?string
    {
        return $this->idprodobjet;
    }

    public function setIdprodobjet(?string $idprodobjet): self
    {
        $this->idprodobjet = $idprodobjet;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\CpcheminRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CpcheminRepository::class)
 */
class Cpchemin
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
    private $nomCpchemin;

    /**
     * @ORM\OneToMany(targetEntity=Cputilisateur::class, mappedBy="Cpchemin")
     */
    private $cputilisateurs;

    public function __construct()
    {
        $this->cputilisateurs = new ArrayCollection();
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

    public function getNomCpchemin(): ?string
    {
        return $this->nomCpchemin;
    }

    public function setNomCpchemin(?string $nomCpchemin): self
    {
        $this->nomCpchemin = $nomCpchemin;

        return $this;
    }

    /**
     * @return Collection<int, Cputilisateur>
     */
    public function getCputilisateurs(): Collection
    {
        return $this->cputilisateurs;
    }

    public function addCputilisateur(Cputilisateur $cputilisateur): self
    {
        if (!$this->cputilisateurs->contains($cputilisateur)) {
            $this->cputilisateurs[] = $cputilisateur;
            $cputilisateur->setCpchemin($this);
        }

        return $this;
    }

    public function removeCputilisateur(Cputilisateur $cputilisateur): self
    {
        if ($this->cputilisateurs->removeElement($cputilisateur)) {
            // set the owning side to null (unless already changed)
            if ($cputilisateur->getCpchemin() === $this) {
                $cputilisateur->setCpchemin(null);
            }
        }

        return $this;
    }
}

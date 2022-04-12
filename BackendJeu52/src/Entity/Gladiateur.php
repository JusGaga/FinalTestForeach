<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\GladiateurRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=GladiateurRepository::class)
 * @ApiResource()
 */
class Gladiateur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"glad_read"})
     */
    private $Nom;

    /**
     * @ORM\Column(type="float")
     * @Groups({"glad_read"})
     */
    private $Adresse;

    /**
     * @ORM\Column(type="float")
     * @Groups({"glad_read"})
     */
    private $Strenght;

    /**
     * @ORM\Column(type="float")
     * @Groups({"glad_read"})
     */
    private $Equilibre;

    /**
     * @ORM\Column(type="float")
     * @Groups({"glad_read"})
     */
    private $Vitesse;

    /**
     * @ORM\Column(type="float")
     * @Groups({"glad_read"})
     */
    private $Strat;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"glad_read"})
     */
    private $Entrainer;

    /**
     * @ORM\ManyToOne(targetEntity=Ludi::class, inversedBy="gladiateurs")
     */
    private $Ludi;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getAdresse(): ?float
    {
        return $this->Adresse;
    }

    public function setAdresse(float $Adresse): self
    {
        $this->Adresse = $Adresse;

        return $this;
    }

    public function getStrenght(): ?float
    {
        return $this->Strenght;
    }

    public function setStrenght(float $Strenght): self
    {
        $this->Strenght = $Strenght;

        return $this;
    }

    public function getEquilibre(): ?float
    {
        return $this->Equilibre;
    }

    public function setEquilibre(float $Equilibre): self
    {
        $this->Equilibre = $Equilibre;

        return $this;
    }

    public function getVitesse(): ?float
    {
        return $this->Vitesse;
    }

    public function setVitesse(float $Vitesse): self
    {
        $this->Vitesse = $Vitesse;

        return $this;
    }

    public function getStrat(): ?float
    {
        return $this->Strat;
    }

    public function setStrat(float $Strat): self
    {
        $this->Strat = $Strat;

        return $this;
    }

    public function getEntrainer(): ?bool
    {
        return $this->Entrainer;
    }

    public function setEntrainer(bool $Entrainer): self
    {
        $this->Entrainer = $Entrainer;

        return $this;
    }

    public function getLudi(): ?Ludi
    {
        return $this->Ludi;
    }

    public function setLudi(?Ludi $Ludi): self
    {
        $this->Ludi = $Ludi;

        return $this;
    }
}

<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Repository\LudiRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=LudiRepository::class)
 * @ApiResource(normalizationContext={"groups" = "ludi_read"})
 *
 */
class Ludi
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"ludi_read","glad_read"})
     */
    private $Nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"ludi_read","glad_read"})
     */
    private $Spe;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"ludi_read","glad_read"})
     */
    private $Complet;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="ludis")
     * @Groups({"ludi_read"})
     */
    private $User;

    /**
     * @ORM\OneToMany(targetEntity=Gladiateur::class, mappedBy="Ludi")
     * @ApiSubresource()
     * @Groups({"ludi_read"})
     */
    private $gladiateurs;

    public function __construct()
    {
        $this->gladiateurs = new ArrayCollection();
    }

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

    public function getSpe(): ?string
    {
        return $this->Spe;
    }

    public function setSpe(string $Spe): self
    {
        $this->Spe = $Spe;

        return $this;
    }

    public function getComplet(): ?bool
    {
        return $this->Complet;
    }

    public function setComplet(bool $Complet): self
    {
        $this->Complet = $Complet;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

    /**
     * @return Collection<int, Gladiateur>
     */
    public function getGladiateurs(): Collection
    {
        return $this->gladiateurs;
    }

    public function addGladiateur(Gladiateur $gladiateur): self
    {
        if (!$this->gladiateurs->contains($gladiateur)) {
            $this->gladiateurs[] = $gladiateur;
            $gladiateur->setLudi($this);
        }

        return $this;
    }

    public function removeGladiateur(Gladiateur $gladiateur): self
    {
        if ($this->gladiateurs->removeElement($gladiateur)) {
            // set the owning side to null (unless already changed)
            if ($gladiateur->getLudi() === $this) {
                $gladiateur->setLudi(null);
            }
        }

        return $this;
    }
}

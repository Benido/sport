<?php

namespace App\Entity;

use App\Repository\StructureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StructureRepository::class)]
class Structure
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?string $installName = null;

    #[ORM\Column]
    private ?bool $active = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $permissions = null;

    #[ORM\ManyToOne(inversedBy: 'structures')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Partenaire $Partenaire = null;

    #[ORM\OneToMany(mappedBy: 'relation', targetEntity: Branch::class, orphanRemoval: true)]
    private Collection $branches;


    public function __construct()
    {
        $this->branches = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInstallName(): ?string
    {
        return $this->installName;
    }

    public function setInstallName(?string $installName): void
    {
        $this->installName = $installName;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getPermissions(): ?string
    {
        return $this->permissions;
    }

    public function setPermissions(string $permissions): self
    {
        $this->permissions = $permissions;

        return $this;
    }

    public function getPartenaire(): ?Partenaire
    {
        return $this->Partenaire;
    }

    public function setPartenaire(?Partenaire $Partenaire): self
    {
        $this->Partenaire = $Partenaire;

        return $this;
    }

    /**
     * @return Collection<int, Branch>
     */
    public function getBranches(): Collection
    {
        return $this->branches;
    }

    public function addBranch(Branch $branch): self
    {
        if (!$this->branches->contains($branch)) {
            $this->branches->add($branch);
            $branch->setRelation($this);
        }

        return $this;
    }

    public function removeBranch(Branch $branch): self
    {
        if ($this->branches->removeElement($branch)) {
            // set the owning side to null (unless already changed)
            if ($branch->getRelation() === $this) {
                $branch->setRelation(null);
            }
        }

        return $this;
    }


}

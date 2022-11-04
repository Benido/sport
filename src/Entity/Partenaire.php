<?php

namespace App\Entity;

use App\Repository\PartenaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PartenaireRepository::class)]
class Partenaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $franchiseName = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $permissions = null;

    #[ORM\Column]
    private ?bool $active = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $shortDescription = null;

    #[ORM\Column(length: 2000, nullable: true)]
    private ?string $longDescription = null;

    #[ORM\OneToMany(mappedBy: 'partenaire', targetEntity: Structure::class, orphanRemoval: true)]
    private Collection $structures;

    #[ORM\OneToOne(mappedBy: 'partenaire', targetEntity: Client::class)]
    private ?Client $client = null;

    public function __construct()
    {
        $this->structures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFranchiseName(): ?string
    {
        return $this->franchiseName;
    }

    public function setFranchiseName(string $franchiseName): self
    {
        $this->franchiseName = $franchiseName;

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

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;
        $this->cascadeActiveStatus();

        return $this;
    }
    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(string $shortDescription): self
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    public function getLongDescription(): ?string
    {
        return $this->longDescription;
    }

    public function setLongDescription(string $longDescription): self
    {
        $this->longDescription = $longDescription;

        return $this;
    }
    /**
     * @return Collection<int, Structure>
     */
    public function getStructures(): Collection
    {
        return $this->structures;
    }

    public function addStructure(Structure $structure): self
    {
        if (!$this->structures->contains($structure)) {
            $this->structures->add($structure);
            $structure->setPartenaire($this);
        }

        return $this;
    }

    public function removeStructure(Structure $structure): self
    {
        if ($this->structures->removeElement($structure)) {
            // set the owning side to null (unless already changed)
            if ($structure->getPartenaire() === $this) {
                $structure->setPartenaire(null);
            }
        }

        return $this;
    }

    public function getClient(): ?Client
{
    return $this->client;
}

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function cascadeActiveStatus(): self
    {
        foreach($this->getStructures() as $structure) {
            $structure->setActive($this->isActive());
        }
        return $this;
    }
}



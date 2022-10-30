<?php

namespace App\Entity;

use Symfony\Component\Uid\Uuid;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client extends User
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private ?Uuid $id = null;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: Partenaire::class)]
    private Collection $Partenaire;

    public function __construct()
    {
        $this->Partenaire = new ArrayCollection();
    }

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    /**
     * @return Collection<int, $this->Partenaire>
     */
    public function getPartenaire(): Collection
    {
        return $this->Partenaire;
    }

    public function addPartenaire(Partenaire $partenaire): self
    {
        if (!$this->Partenaire->contains($partenaire)) {
            $this->Partenaire->add($partenaire);
            $partenaire->setClient($this);
        }

        return $this;
    }

    public function removePartenaire(Partenaire $partenaire): self
    {
        if ($this->Partenaire->removeElement($partenaire)) {
            // set the owning side to null (unless already changed)
            if ($partenaire->getClient() === $this) {
                $partenaire->setClient(null);
            }
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use Symfony\Component\Uid\Uuid;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use App\Repository\ClientRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client extends User
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private ?Uuid $id = null;

    #[ORM\OneToOne(inversedBy: 'client', targetEntity: Partenaire::class)]
    private ?Partenaire $partenaire;

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getPartenaire(): Partenaire
    {
        return $this->partenaire;
    }

    public function setPartenaire($partenaire): self
    {
        $this->partenaire = $partenaire;
        return $this;
    }

}

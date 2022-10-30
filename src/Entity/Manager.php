<?php

namespace App\Entity;

use App\Repository\ManagerRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: ManagerRepository::class)]
class Manager extends User
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private ?Uuid $id = null;

    #[ORM\OneToOne(inversedBy: 'manager', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Branch $branch = null;

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getBranch(): ?Branch
    {
        return $this->branch;
    }

    public function setBranch(Branch $branch): self
    {
        $this->branch = $branch;

        return $this;
    }
}

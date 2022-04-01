<?php

namespace App\Entity;

use App\Repository\ManagerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ManagerRepository::class)]
class Manager extends User
{

    #[ORM\OneToOne(inversedBy: 'manager', targetEntity: Establishment::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $establishment;

    public function getEstablishment(): ?Establishment
    {
        return $this->establishment;
    }

    public function setEstablishment(Establishment $establishment): self
    {
        $this->establishment = $establishment;

        return $this;
    }
}

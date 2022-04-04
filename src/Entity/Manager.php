<?php

namespace App\Entity;

use App\Repository\ManagerRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: ManagerRepository::class)]
class Manager implements UserInterface, PasswordAuthenticatedUserInterface
{
    use UserTrait;

    #[ORM\OneToOne(inversedBy: 'manager', targetEntity: Establishment::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: true)]
    private ?Establishment $establishment;

    public function getEstablishment(): ?Establishment
    {
        return $this->establishment;
    }

    public function setEstablishment(?Establishment $establishment): self
    {
        if ($this->establishment === null || ($this->establishment !== $establishment &&
                $establishment->getManager() === null)) {
            $this->establishment = $establishment;
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->firstname." ".$this->lastname;
    }
}

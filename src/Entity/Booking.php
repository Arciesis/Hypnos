<?php

namespace App\Entity;

use App\Repository\BookingRepository;
use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookingRepository::class)]
class Booking
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'datetime_immutable')]
    private DateTimeImmutable $createdAt;

    #[ORM\Column(type: 'datetime')]
    private DateTimeInterface $startBooking;

    #[ORM\Column(type: 'datetime')]
    private DateTimeInterface $endBooking;

    #[ORM\ManyToOne(targetEntity: Customer::class, inversedBy: 'bookings')]
    #[ORM\JoinColumn(nullable: false)]
    private Customer $customer;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getStartBooking(): ?DateTimeInterface
    {
        return $this->startBooking;
    }

    public function setStartBooking(DateTimeInterface $startBooking): self
    {
        $this->startBooking = $startBooking;

        return $this;
    }

    public function getEndBooking(): ?DateTimeInterface
    {
        return $this->endBooking;
    }

    public function setEndBooking(DateTimeInterface $endBooking): self
    {
        $this->endBooking = $endBooking;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }
}

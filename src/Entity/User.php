<?php

namespace App\Entity;

use App\Repository\DoctrineUserRepository;
use Doctrine\ORM\Mapping as ORM;


class User
{
    private ?int $id;
    private string $name;
    private string $email;
    private \DateTimeImmutable $createdAt;
    private \DateTime $updatedAt;

    public function __construct(string $name, string $email)
    {
        $this->name = $name;
        $this->email = $email;
        $this->createdAt = new \DateTimeImmutable();
        $this->markAsUpdated();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function markAsUpdated(): void
    {
        $this->updatedAt = new \DateTime();
    }
}

<?php

namespace App\Entity;

use App\Repository\DoctrineUserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;


class User
{
    private string $id;
    private string $name;
    private string $email;
    private \DateTimeImmutable $createdAt;
    private \DateTime $updatedAt;
    private Profile $profile;
    private ?Country $country;


    public function __construct(string $name, string $email)
    {
        $this->id = Uuid::v4()->toRfc4122();
        $this->name = $name;
        $this->email = $email;
        $this->createdAt = new \DateTimeImmutable();
        $this->markAsUpdated();
        $this->profile = new Profile($this);
        $this->country = null;
    }

    public function getId(): string
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

    public function getProfile(): Profile
    {
        return $this->profile;
    }


    public function setProfile(Profile $profile): void
    {
        $this->profile = $profile;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): void
    {
        $this->country = $country;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'createdOn' => $this->createdAt->format(\DateTimeImmutable::RFC3339),
            'updatedOn' => $this->updatedAt->format(\DateTime::RFC3339),
            'profile' => $this->profile->toArray(),
            'country' => $this->country ? $this->country->toArray() : null,
            /*'profile' => [
                'id' => $this->profile->getId(),
                'pictureUrl' => $this->profile->getPictureUrl(),
            ],*/
        ];
    }

    public function toString(): string
    {
      //return $this->name;
      return $this->name . ' ' . $this->email;
    }
}

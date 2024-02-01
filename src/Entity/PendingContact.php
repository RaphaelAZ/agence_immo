<?php

namespace App\Entity;

use App\Repository\PendingContactRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PendingContactRepository::class)]
class PendingContact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateContact = null;
    #[ORM\Column(length: 255)]
    private ?string $phone = null;
    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\ManyToOne(targetEntity:Announce::class)]
    private $Announce;

    #[ORM\ManyToOne(targetEntity:User::class)]
    private $User;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?bool $pending = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateContact(): ?\DateTimeInterface
    {
        return $this->dateContact;
    }

    public function setDateContact(\DateTimeInterface $dateContact): static
    {
        $this->dateContact = $dateContact;

        return $this;
    }
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone)
    {
        $this->phone = $phone;

        return $this;
    }
    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }
    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $user): self
    {
        $this->User = $user;

        return $this;
    }
    public function getAnnounce(): ?Announce
    {
        return $this->Announce;
    }

    public function setAnnounce(?Announce $annonce): self
    {
        $this->Announce = $annonce;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function isPending(): ?bool
    {
        return $this->pending;
    }

    public function setPending(bool $pending): static
    {
        $this->pending = $pending;

        return $this;
    }
}

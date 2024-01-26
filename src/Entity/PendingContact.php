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

    #[ORM\OneToOne(targetEntity:Announce::class)]
    private $Announce;

    #[ORM\OneToOne(targetEntity:User::class)]
    private $User;

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
}

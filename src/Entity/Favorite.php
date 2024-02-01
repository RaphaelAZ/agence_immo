<?php

namespace App\Entity;

use App\Repository\FavoriteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FavoriteRepository::class)]
class Favorite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateFavorite = null;
    #[ORM\ManyToOne(targetEntity:Announce::class)]
    private $Announce;

    #[ORM\ManyToOne(targetEntity:User::class)]
    private $User;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateFavorite(): ?\DateTimeInterface
    {
        return $this->dateFavorite;
    }

    public function setDateFavorite(\DateTimeInterface $dateFavorite): static
    {
        $this->dateFavorite = $dateFavorite;

        return $this;
    }
}

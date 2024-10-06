<?php

namespace App\Entity;

use App\Repository\WatchHistoryRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WatchHistoryRepository::class)]
class WatchHistory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'media')]
    private ?User $userWatchHistory = null;

    #[ORM\ManyToOne(inversedBy: 'watchHistories')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Media $media = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $lastWatchedDateAt = null;

    #[ORM\Column]
    private ?int $numberOfViews = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserWatchHistory(): ?User
    {
        return $this->userWatchHistory;
    }

    public function setUserWatchHistory(?User $userWatchHistory): static
    {
        $this->userWatchHistory = $userWatchHistory;

        return $this;
    }

    public function getMedia(): ?Media
    {
        return $this->media;
    }

    public function setMedia(?Media $media): static
    {
        $this->media = $media;

        return $this;
    }

    public function getLastWatchedDateAt(): ?\DateTimeInterface
    {
        return $this->lastWatchedDateAt;
    }

    public function setLastWatchedDateAt(\DateTimeInterface $lastWatchedDateAt): static
    {
        $this->lastWatchedDateAt = $lastWatchedDateAt;

        return $this;
    }

    public function getNumberOfViews(): ?int
    {
        return $this->numberOfViews;
    }

    public function setNumberOfViews(int $numberOfViews): static
    {
        $this->numberOfViews = $numberOfViews;

        return $this;
    }
}
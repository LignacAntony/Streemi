<?php

namespace App\Entity;

use App\Repository\PlaylistSubscriptionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlaylistSubscriptionRepository::class)]
class PlaylistSubscription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'playlistSubscriptions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $userPlaylistSubscription = null;

    #[ORM\ManyToOne(inversedBy: 'playlistSubscriptions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Playlist $playlist = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $subscribedDateAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserPlaylistSubscription(): ?User
    {
        return $this->userPlaylistSubscription;
    }

    public function setUserPlaylistSubscription(?User $userPlaylistSubscription): static
    {
        $this->userPlaylistSubscription = $userPlaylistSubscription;

        return $this;
    }

    public function getPlaylist(): ?Playlist
    {
        return $this->playlist;
    }

    public function setPlaylist(?Playlist $playlist): static
    {
        $this->playlist = $playlist;

        return $this;
    }

    public function getSubscribedDateAt(): ?\DateTimeImmutable
    {
        return $this->subscribedDateAt;
    }

    public function setSubscribedDateAt(\DateTimeImmutable $subscribedDateAt): static
    {
        $this->subscribedDateAt = $subscribedDateAt;

        return $this;
    }
}

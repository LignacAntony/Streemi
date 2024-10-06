<?php

namespace App\Entity;

use App\Enum\AccountStatusEnum;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, SubscriptionHistory>
     */
    #[ORM\OneToMany(targetEntity: SubscriptionHistory::class, mappedBy: 'subscriber')]
    private Collection $subscriptionHistories;

    #[ORM\Column(length: 100)]
    private ?string $username = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Subscription $currentSubscribtion = null;

    #[ORM\Column(enumType: AccountStatusEnum::class)]
    private ?AccountStatusEnum $accountStatusEnum = null;

    /**
     * @var Collection<int, Playlist>
     */
    #[ORM\OneToMany(targetEntity: Playlist::class, mappedBy: 'userPlaylist')]
    private Collection $playlists;

    /**
     * @var Collection<int, PlaylistSubscription>
     */
    #[ORM\OneToMany(targetEntity: PlaylistSubscription::class, mappedBy: 'userPlaylistSubscription')]
    private Collection $playlistSubscriptions;

    /**
     * @var Collection<int, Comment>
     */
    #[ORM\OneToMany(targetEntity: Comment::class, mappedBy: 'userComment')]
    private Collection $comments;

    /**
     * @var Collection<int, WatchHistory>
     */
    #[ORM\OneToMany(targetEntity: WatchHistory::class, mappedBy: 'userWatchHistory')]
    private Collection $watchHistories;

    public function __construct()
    {
        $this->subscriptionHistories = new ArrayCollection();
        $this->playlists = new ArrayCollection();
        $this->playlistSubscriptions = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->watchHistories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, SubscriptionHistory>
     */
    public function getSubscription(): Collection
    {
        return $this->subscriptionHistories;
    }

    public function addSubscriptionHistories(SubscriptionHistory $subscription): static
    {
        if (!$this->subscriptionHistories->contains($subscription)) {
            $this->subscriptionHistories->add($subscription);
            $subscription->setSubscriber($this);
        }

        return $this;
    }

    public function removeSubscriptionHistories(SubscriptionHistory $subscription): static
    {
        if ($this->subscriptionHistories->removeElement($subscription)) {
            // set the owning side to null (unless already changed)
            if ($subscription->getSubscriber() === $this) {
                $subscription->setSubscriber(null);
            }
        }

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getCurrentSubscribtion(): ?Subscription
    {
        return $this->currentSubscribtion;
    }

    public function setCurrentSubscribtion(?Subscription $currentSubscribtion): static
    {
        $this->currentSubscribtion = $currentSubscribtion;

        return $this;
    }

    public function getAccountStatusEnum(): ?AccountStatusEnum
    {
        return $this->accountStatusEnum;
    }

    public function setAccountStatusEnum(AccountStatusEnum $accountStatusEnum): static
    {
        $this->accountStatusEnum = $accountStatusEnum;

        return $this;
    }

    /**
     * @return Collection<int, Playlist>
     */
    public function getPlaylists(): Collection
    {
        return $this->playlists;
    }

    public function addPlaylist(Playlist $playlist): static
    {
        if (!$this->playlists->contains($playlist)) {
            $this->playlists->add($playlist);
            $playlist->setUserPlaylist($this);
        }

        return $this;
    }

    public function removePlaylist(Playlist $playlist): static
    {
        if ($this->playlists->removeElement($playlist)) {
            // set the owning side to null (unless already changed)
            if ($playlist->getUserPlaylist() === $this) {
                $playlist->setUserPlaylist(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PlaylistSubscription>
     */
    public function getPlaylistSubscriptions(): Collection
    {
        return $this->playlistSubscriptions;
    }

    public function addPlaylistSubscription(PlaylistSubscription $playlistSubscription): static
    {
        if (!$this->playlistSubscriptions->contains($playlistSubscription)) {
            $this->playlistSubscriptions->add($playlistSubscription);
            $playlistSubscription->setUserPlaylistSubscription($this);
        }

        return $this;
    }

    public function removePlaylistSubscription(PlaylistSubscription $playlistSubscription): static
    {
        if ($this->playlistSubscriptions->removeElement($playlistSubscription)) {
            // set the owning side to null (unless already changed)
            if ($playlistSubscription->getUserPlaylistSubscription() === $this) {
                $playlistSubscription->setUserPlaylistSubscription(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): static
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setUserComment($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getUserComment() === $this) {
                $comment->setUserComment(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, WatchHistory>
     */
    public function getWatchHistories(): Collection
    {
        return $this->watchHistories;
    }

    public function addMedium(WatchHistory $medium): static
    {
        if (!$this->watchHistories->contains($medium)) {
            $this->watchHistories->add($medium);
            $medium->setUserWatchHistory($this);
        }

        return $this;
    }

    public function removeMedium(WatchHistory $medium): static
    {
        if ($this->watchHistories->removeElement($medium)) {
            // set the owning side to null (unless already changed)
            if ($medium->getUserWatchHistory() === $this) {
                $medium->setUserWatchHistory(null);
            }
        }

        return $this;
    }
}

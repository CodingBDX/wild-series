<?php

namespace App\Entity;

use App\Repository\EpisodeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EpisodeRepository::class)]
class Episode
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'episode', targetEntity: Season::class, orphanRemoval: true)]
    private Collection $season_id;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column]
    private ?int $number = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $synopsis = null;

    public function __construct()
    {
        $this->season_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Season>
     */
    public function getSeasonId(): Collection
    {
        return $this->season_id;
    }

    public function addSeasonId(Season $seasonId): self
    {
        if (!$this->season_id->contains($seasonId)) {
            $this->season_id->add($seasonId);
            $seasonId->setEpisode($this);
        }

        return $this;
    }

    public function removeSeasonId(Season $seasonId): self
    {
        if ($this->season_id->removeElement($seasonId)) {
            // set the owning side to null (unless already changed)
            if ($seasonId->getEpisode() === $this) {
                $seasonId->setEpisode(null);
            }
        }

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    public function setSynopsis(?string $synopsis): self
    {
        $this->synopsis = $synopsis;

        return $this;
    }
}

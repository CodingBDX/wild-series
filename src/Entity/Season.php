<?php

namespace App\Entity;

use App\Repository\SeasonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SeasonRepository::class)]
class Season
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'season', targetEntity: Program::class, orphanRemoval: true)]
    private Collection $program_id;

    #[ORM\Column]
    private ?int $number = null;

    #[ORM\Column]
    private ?int $year = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'season_id')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Episode $episode = null;

    public function __construct()
    {
        $this->program_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

        public function setProgram(): ?int
        {
            return $this->id;
        }

    /**
     * @return Collection<int, Program>
     */
    public function getProgramId(): Collection
    {
        return $this->program_id;
    }

    public function addProgramId(Program $programId): self
    {
        if (!$this->program_id->contains($programId)) {
            $this->program_id->add($programId);
            $programId->setSeason($this);
        }

        return $this;
    }

    public function removeProgramId(Program $programId): self
    {
        if ($this->program_id->removeElement($programId)) {
            // set the owning side to null (unless already changed)
            if ($programId->getSeason() === $this) {
                $programId->setSeason(null);
            }
        }

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

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getEpisode(): ?Episode
    {
        return $this->episode;
    }

    public function setEpisode(?Episode $episode): self
    {
        $this->episode = $episode;

        return $this;
    }
}

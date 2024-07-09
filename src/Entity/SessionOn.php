<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;
use App\Repository\SessionOnRepository;


#[ORM\Entity(repositoryClass: SessionOnRepository::class)]
class SessionOn
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $idUser = null;

    #[ORM\Column(length: 50)]
    private ?string $dateStarted = null;


    #[ORM\Column(length: 50)]
    private ?string $hourStarted = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getidUser(): ?string
    {
        return $this->idUser;
    }

    public function setidUser(string $idUser): static
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function getDateStarted(): ?string
    {
        return $this->dateStarted;
    }

    public function setDateStarted(string $timeStarted): static
    {
        $this->dateStarted = $timeStarted;

        return $this;
    }
   
   
    public function gethourStarted(): ?string
    {
        return $this->hourStarted;
    }

    public function sethourStarted(string $hourStarted): static
    {
        $this->hourStarted = $hourStarted;

        return $this;
    }


}

<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EppnRepository")
 */
class Eppn
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $eppn;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEppn(): ?string
    {
        return $this->eppn;
    }

    public function setEppn(string $eppn): self
    {
        $this->eppn = $eppn;

        return $this;
    }
}

<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CreatureSource
 *
 * @ORM\Table(name="creature_source", indexes={@ORM\Index(name="FK_CAA7F10F9AB048", columns={"creature_id"})})
 * @ORM\Entity
 */
class CreatureSource
{
    /**
     * @var int
     * 
     * @ORM\Column(name="source_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idSource;

    /**
     * @var int
     * 
     * @ORM\Column(name="creature_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idCreature;

    /**
     * @var int
     * 
     * @ORM\Column(name="page", type="integer", nullable=false)
     */
    private $page;

    public function getIdSource(): ?int
    {
        return $this->idSource;
    }

    public function getIdCreature(): ?int
    {
        return $this->idCreature;
    }

    public function getPage(): ?int
    {
        return $this->page;
    }

    public function setPage(int $page): self
    {
        $this->page = $page;

        return $this;
    }

}
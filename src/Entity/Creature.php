<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Creature
 *
 * @ORM\Table(name="creature", indexes={@ORM\Index(name="IDX_2A6C6AF41BD125E3", columns={"id_type"}), @ORM\Index(name="FK_source_id", columns={"id_source"}), @ORM\Index(name="FK_alignment_id", columns={"id_alignment"}), @ORM\Index(name="IDX_2A6C6AF497100157", columns={"id_size"})})
 * @ORM\Entity
 */
class Creature
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="challenge", type="integer", nullable=false)
     */
    private $challenge;

    /**
     * @var int
     *
     * @ORM\Column(name="page", type="integer", nullable=false)
     */
    private $page;

    /**
     * @var \CreatureType
     *
     * @ORM\ManyToOne(targetEntity="CreatureType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_type", referencedColumnName="id")
     * })
     */
    private $idType;

    /**
     * @var \CreatureSize
     *
     * @ORM\ManyToOne(targetEntity="CreatureSize")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_size", referencedColumnName="id")
     * })
     */
    private $idSize;

    /**
     * @var \Alignment
     *
     * @ORM\ManyToOne(targetEntity="Alignment")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_alignment", referencedColumnName="id")
     * })
     */
    private $idAlignment;

    /**
     * @var \Source
     *
     * @ORM\ManyToOne(targetEntity="Source")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_source", referencedColumnName="id")
     * })
     */
    private $idSource;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getChallenge(): ?int
    {
        return $this->challenge;
    }

    public function setChallenge(int $challenge): self
    {
        $this->challenge = $challenge;

        return $this;
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

    public function getIdType(): ?CreatureType
    {
        return $this->idType;
    }

    public function setIdType(?CreatureType $idType): self
    {
        $this->idType = $idType;

        return $this;
    }

    public function getIdSize(): ?CreatureSize
    {
        return $this->idSize;
    }

    public function setIdSize(?CreatureSize $idSize): self
    {
        $this->idSize = $idSize;

        return $this;
    }

    public function getIdAlignment(): ?Alignment
    {
        return $this->idAlignment;
    }

    public function setIdAlignment(?Alignment $idAlignment): self
    {
        $this->idAlignment = $idAlignment;

        return $this;
    }

    public function getIdSource(): ?Source
    {
        return $this->idSource;
    }

    public function setIdSource(?Source $idSource): self
    {
        $this->idSource = $idSource;

        return $this;
    }


}

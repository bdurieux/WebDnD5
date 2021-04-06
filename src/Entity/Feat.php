<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Feat
 *
 * @ORM\Table(name="feat", indexes={@ORM\Index(name="fk_feat_source_id", columns={"id_source"})})
 * @ORM\Entity
 */
class Feat
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
     * @var string
     *
     * @ORM\Column(name="prerequisite", type="string", length=255, nullable=false, options={"default"="-"})
     */
    private $prerequisite = '-';

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="page", type="smallint", nullable=false)
     */
    private $page;

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

    public function getPrerequisite(): ?string
    {
        return $this->prerequisite;
    }

    public function setPrerequisite(string $prerequisite): self
    {
        $this->prerequisite = $prerequisite;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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

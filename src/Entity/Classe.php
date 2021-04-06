<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Classe
 *
 * @ORM\Table(name="classe", indexes={@ORM\Index(name="FK_class_source_id", columns={"id_source"})})
 * @ORM\Entity
 */
class Classe
{
    //js: proficiency bonus = Math.floor(level/4.2 +2)

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
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="hit_dice", type="integer", nullable=false)
     */
    private $hitDice;

    /**
     * @var string
     *
     * @ORM\Column(name="armors", type="string", length=255, nullable=false)
     */
    private $armors;

    /**
     * @var string
     *
     * @ORM\Column(name="weapons", type="string", length=255, nullable=false)
     */
    private $weapons;

    /**
     * @var string
     *
     * @ORM\Column(name="tools", type="string", length=255, nullable=false)
     */
    private $tools;

    /**
     * @var string
     *
     * @ORM\Column(name="saves", type="string", length=255, nullable=false)
     */
    private $saves;

    /**
     * @var string
     *
     * @ORM\Column(name="skills", type="string", length=255, nullable=false)
     */
    private $skills;

    /**
     * @var int
     *
     * @ORM\Column(name="page", type="integer", nullable=false)
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getHitDice(): ?int
    {
        return $this->hitDice;
    }

    public function setHitDice(int $hitDice): self
    {
        $this->hitDice = $hitDice;

        return $this;
    }

    public function getArmors(): ?string
    {
        return $this->armors;
    }

    public function setArmors(string $armors): self
    {
        $this->armors = $armors;

        return $this;
    }

    public function getWeapons(): ?string
    {
        return $this->weapons;
    }

    public function setWeapons(string $weapons): self
    {
        $this->weapons = $weapons;

        return $this;
    }

    public function getTools(): ?string
    {
        return $this->tools;
    }

    public function setTools(string $tools): self
    {
        $this->tools = $tools;

        return $this;
    }

    public function getSaves(): ?string
    {
        return $this->saves;
    }

    public function setSaves(string $saves): self
    {
        $this->saves = $saves;

        return $this;
    }

    public function getSkills(): ?string
    {
        return $this->skills;
    }

    public function setSkills(string $skills): self
    {
        $this->skills = $skills;

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

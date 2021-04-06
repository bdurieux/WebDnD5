<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SubclassTrait
 *
 * @ORM\Table(name="subclass_trait", indexes={@ORM\Index(name="FK_subclasstrait_subclass_id", columns={"id_subclass"})})
 * @ORM\Entity
 */
class SubclassTrait
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
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="level", type="integer", nullable=false)
     */
    private $level;

    /**
     * @var \Subclass
     *
     * @ORM\ManyToOne(targetEntity="Subclass")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_subclass", referencedColumnName="id")
     * })
     */
    private $idSubclass;

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

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getIdSubclass(): ?Subclass
    {
        return $this->idSubclass;
    }

    public function setIdSubclass(?Subclass $idSubclass): self
    {
        $this->idSubclass = $idSubclass;

        return $this;
    }


}

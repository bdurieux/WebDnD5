<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Source
 *
 * @ORM\Table(name="dd_source", indexes={@ORM\Index(name="FK_source_setting_id", columns={"id_setting"})})
 * @ORM\Entity
 */
class Source
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
     * @ORM\Column(name="label", type="string", length=255, nullable=false)
     */
    private $label;

    /**
     * @var bool
     *
     * @ORM\Column(name="official", type="boolean", nullable=false)
     */
    private $official = '0';

    /**
     * @var \Setting
     *
     * @ORM\ManyToOne(targetEntity="Setting")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_setting", referencedColumnName="id")
     * })
     */
    private $idSetting;

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

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getOfficial(): ?bool
    {
        return $this->official;
    }

    public function setOfficial(bool $official): self
    {
        $this->official = $official;

        return $this;
    }

    public function getIdSetting(): ?Setting
    {
        return $this->idSetting;
    }

    public function setIdSetting(?Setting $idSetting): self
    {
        $this->idSetting = $idSetting;

        return $this;
    }


}

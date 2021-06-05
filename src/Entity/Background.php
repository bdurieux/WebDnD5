<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Background
 *
 * @ORM\Table(name="background", indexes={@ORM\Index(name="FK_background_source_id", columns={"id_source"})})
 * @ORM\Entity
 */
class Background
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
     * @ORM\Column(name="skills", type="string", length=255, nullable=false)
     */
    private $skills;

    /**
     * @var string
     *
     * @ORM\Column(name="tools", type="string", length=255, nullable=false)
     */
    private $tools;

    /**
     * @var string
     *
     * @ORM\Column(name="languages", type="string", length=255, nullable=false)
     */
    private $languages;

    /**
     * @var string
     *
     * @ORM\Column(name="gear", type="string", length=255, nullable=false)
     */
    private $gear;

    /**
     * @var string
     *
     * @ORM\Column(name="feature_name", type="string", length=255, nullable=false)
     */
    private $featureName;

    /**
     * @var string
     *
     * @ORM\Column(name="feature", type="text", length=65535, nullable=false)
     */
    private $feature;

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

    public function getSkills(): ?string
    {
        return $this->skills;
    }

    public function setSkills(string $skills): self
    {
        $this->skills = $skills;

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

    public function getLanguages(): ?string
    {
        return $this->languages;
    }

    public function setLanguages(string $languages): self
    {
        $this->languages = $languages;

        return $this;
    }

    public function getGear(): ?string
    {
        return $this->gear;
    }

    public function setGear(string $gear): self
    {
        $this->gear = $gear;

        return $this;
    }

    public function getFeatureName(): ?string
    {
        return $this->featureName;
    }

    public function setFeatureName(string $featureName): self
    {
        $this->featureName = $featureName;

        return $this;
    }

    public function getFeature(): ?string
    {
        return $this->feature;
    }

    public function setFeature(string $feature): self
    {
        $this->feature = $feature;

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

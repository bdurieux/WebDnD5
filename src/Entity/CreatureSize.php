<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CreatureSize
 *
 * @ORM\Table(name="creature_size")
 * @ORM\Entity
 */
class CreatureSize
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
     * @ORM\Column(name="hit_dice", type="smallint", nullable=false)
     */
    private $hitDice;

    /**
     * @var int
     *
     * @ORM\Column(name="square_space", type="smallint", nullable=false)
     */
    private $squareSpace;

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

    public function getHitDice(): ?int
    {
        return $this->hitDice;
    }

    public function setHitDice(int $hitDice): self
    {
        $this->hitDice = $hitDice;

        return $this;
    }

    public function getSquareSpace(): ?int
    {
        return $this->squareSpace;
    }

    public function setSquareSpace(int $squareSpace): self
    {
        $this->squareSpace = $squareSpace;

        return $this;
    }


}

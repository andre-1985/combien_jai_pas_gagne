<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\SelectionLotoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SelectionLotoRepository::class)]
class SelectionLoto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'simple_array')]
    #[Assert\Count(
        max: 5,
        maxMessage: 'Vous avez sélectionner trop de numéros, maximum 5 !',
    )]
    #[Assert\All([
        new Assert\Type(
            type: 'integer'
        ),
        new Assert\GreaterThanOrEqual(
            value: 1,
        ),
        new Assert\LessThanOrEqual(
            value: 49,
        )
    ])]
    private ?array $ballsSelectionLoto;

    #[ORM\Column(type: 'simple_array')]
    #[Assert\Count(
        max: 1,
        maxMessage: 'Vous avez sélectionner trop de numéro chance, maximum 1 !',
    )]
    #[Assert\All([
        new Assert\Type(
            type: 'integer'
        ),
        new Assert\GreaterThanOrEqual(
            value: 1,
        ),
        new Assert\LessThanOrEqual(
            value: 10,
        )
    ])]
    private ?array $luckyNumberSelection;

    #[Assert\IsTrue(message: 'Vous devez sélectionner au moins 2 numéros !')]
    public function isValid(): bool
    {
        return count($this->ballsSelectionLoto) + count($this->luckyNumberSelection) >= 2;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBallsSelectionLoto(): array
    {
        return $this->ballsSelectionLoto;
    }

    public function setBallsSelectionLoto(?array $ballsSelectionLoto): self
    {
        $this->ballsSelectionLoto = $ballsSelectionLoto;

        return $this;
    }

    public function getLuckyNumberSelection(): array
    {
        return $this->luckyNumberSelection;
    }

    public function setLuckyNumberSelection(?array $luckyNumberSelection): self
    {
        $this->luckyNumberSelection = $luckyNumberSelection;

        return $this;
    }
}

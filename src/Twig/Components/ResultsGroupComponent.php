<?php

namespace App\Twig\Components;

use App\Entity\SelectionEuromillions;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('results_group')]
final class ResultsGroupComponent
{
    public SelectionEuromillions $userSelection;
    public string $key;
    public array $groupResult;
}

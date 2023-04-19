<?php

namespace App\Twig\Components;

use App\Entity\SelectionEuromillions;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent('results_group')]
final class ResultsGroupComponent extends AbstractController
{
    use DefaultActionTrait;

    public SelectionEuromillions $userSelection;
    public string $key;
    public array $groupResult;
}

<?php

namespace App\Twig\Components;

use App\Entity\SelectionEuromillions;
use App\Form\GridEuromillionsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent('grid_euromillions')]
final class GridEuromillionsComponent extends AbstractController
{
    use DefaultActionTrait;
    use ComponentWithFormTrait;

    #[LiveProp(fieldName: 'data')]
    public ?SelectionEuromillions $selectionEuromillions = null;

    protected function instantiateForm(): FormInterface
    {
        return $this->createForm(GridEuromillionsType::class, $this->selectionEuromillions);
    }
}

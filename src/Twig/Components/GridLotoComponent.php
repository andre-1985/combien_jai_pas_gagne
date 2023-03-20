<?php

namespace App\Twig\Components;

use App\Entity\SelectionLoto;
use App\Form\GridLotoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent('grid_loto')]
final class GridLotoComponent extends AbstractController
{
    use DefaultActionTrait;
    use ComponentWithFormTrait;

    #[LiveProp(fieldName: 'data')]
    public ?SelectionLoto $selectionLoto = null;

    protected function instantiateForm(): FormInterface
    {
        return $this->createForm(GridLotoType::class, $this->selectionLoto);
    }
}

<?php

namespace App\Twig\Components;

use App\Entity\SelectionLoto;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('card_user_selection_loto')]
final class CardUserSelectionLotoComponent
{
    public SelectionLoto $userSelection;
}

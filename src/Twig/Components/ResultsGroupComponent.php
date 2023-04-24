<?php

namespace App\Twig\Components;

use App\Entity\SelectionEuromillions;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent('results_group')]
final class ResultsGroupComponent extends AbstractController
{
    use DefaultActionTrait;

    public SelectionEuromillions $userSelection;
    public string $key;
    #[LiveProp]
    public array $groupResult;
    #[LiveAction]
    public function getSessionGroupResult(Request $request): Response
    {
        $session = $request->getSession();

        if (!$session->has(name: 'groupResult'))
        {
            $session->set('groupResult', $this->groupResult);
        }
        return $this->render('pages/grid_euromillions/groupResult_euromillions.html.twig', [
            'groupResult' => $session->get('groupResult'),
        ]);
    }
}

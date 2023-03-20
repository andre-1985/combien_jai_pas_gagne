<?php

namespace App\Controller;

use App\Entity\SelectionEuromillions;
use App\Form\GridEuromillionsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GridEuromillionsController extends AbstractController
{
    #[Route('/grilleEuromillions', name: 'grid_euromillions')]
    public function index(Request $request): Response
    {
        $selectionEuromillions = new SelectionEuromillions();

        $form = $this->createForm(GridEuromillionsType::class, $selectionEuromillions)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            return $this->render(
                'pages/grid_euromillions/user_euromillions_results.html.twig', [
                    'data' => $data,
                ]
            );
        }

        return $this->render('pages/grid_euromillions/index.html.twig', [
            'form' => $form,
            'selectionEuromillions' => $selectionEuromillions,
            ]
        );
    }
}

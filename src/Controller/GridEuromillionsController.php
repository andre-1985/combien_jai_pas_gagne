<?php

namespace App\Controller;

use App\Entity\SelectionEuromillions;
use App\Form\GridEuromillionsType;
use App\Repository\DrawEuromillionsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GridEuromillionsController extends AbstractController
{
    #[Route('/grilleEuromillions', name: 'grid_euromillions')]
    public function index(Request $request, DrawEuromillionsRepository $repository): Response
    {
        $selectionEuromillions = new SelectionEuromillions();

        $form = $this->createForm(GridEuromillionsType::class, $selectionEuromillions)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $userSelectionRequest = $repository->findDrawsByUserSelection($data->ballsSelectionEuromillions, $data->starsSelection);

            /*if (!empty($data->ballsSelectionEuromillions) && !empty($data->starsSelection)) {
                $tutu = 'toto + titi: Ok';

                return $this->render(
                    'pages/grid_euromillions/user_euromillions_results.html.twig', [
                        'tutu' => $tutu,
                    ]
                );
            }

            elseif (!empty($data->ballsSelectionEuromillions) && empty($data->starsSelection)) {
                $tutu = 'toto: Ok et titi: vide';

                return $this->render(
                    'pages/grid_euromillions/user_euromillions_results.html.twig', [
                        'tutu' => $tutu,
                    ]
                );
            }

            elseif (empty($data->ballsSelectionEuromillions) && !empty($data->starsSelection)) {
                $tutu = 'toto: vide et titi: ok';

                return $this->render(
                    'pages/grid_euromillions/user_euromillions_results.html.twig', [
                        'tutu' => $tutu,
                    ]
                );
            }*/

            return $this->render(
                'pages/grid_euromillions/user_euromillions_results.html.twig', [
                'data' => $data,
                'userSelectionRequest' => $userSelectionRequest
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

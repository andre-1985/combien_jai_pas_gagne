<?php

namespace App\Controller;

use App\Entity\SelectionLoto;
use App\Form\GridLotoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GridLotoController extends AbstractController
{
    #[Route('/grilleLoto', name: 'grid_loto')]
    public function index(Request $request): Response
    {
        $selectionLoto = new SelectionLoto();

        $form = $this->createForm(GridLotoType::class, $selectionLoto)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            return $this->render(
                'pages/grid_loto/user_loto_results.html.twig', [
                    'data' => $data,
                ]
            );
        }

        return $this->render('pages/grid_loto/index.html.twig', [
            'form' => $form,
            'selectionLoto' => $selectionLoto,
            ]
        );
    }
}

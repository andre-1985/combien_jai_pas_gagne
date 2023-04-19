<?php

namespace App\Controller;

use App\Repository\DrawEuromillionsRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DrawsEuromillionsController extends AbstractController
{
    #[Route('/tiragesEuromillions', name: 'draws_euromillions')]
    public function index(
        DrawEuromillionsRepository $repository,
        PaginatorInterface $paginator,
        Request $request
    ): Response
    {
        $drawsEuromillions = $repository->findAll();

        $allDrawsEuromillions = $paginator->paginate(
            $drawsEuromillions,
            $request->query->getInt('page', 1),
            40
        );

        return $this->render('pages/draws_euromillions/index.html.twig', [
            'allDrawsEuromillions' => $allDrawsEuromillions,
        ]);
    }
}

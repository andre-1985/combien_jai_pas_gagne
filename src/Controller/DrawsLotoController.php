<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DrawsLotoController extends AbstractController
{
    #[Route('/tiragesLoto', name: 'draws_loto')]
    public function index(): Response
    {
        return $this->render('pages/draws_loto/index.html.twig', [
            'controller_name' => 'DrawsLotoController',
        ]);
    }
}
